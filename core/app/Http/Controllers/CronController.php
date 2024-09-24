<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Lib\Capital;
use App\Lib\CurlRequest;
use App\Models\CronJob;
use App\Models\CronJobLog;
use App\Models\Invest;
use App\Models\Transaction;
use Carbon\Carbon;

class CronController extends Controller
{
    public function cron()
    {
        $general = gs();
        $general->last_cron = now();
        $general->save();

        $crons = CronJob::with('schedule');

        if (request()->alias) {
            $crons->where('alias', request()->alias);
        } else {
            $crons->where('next_run', '<', now())->where('is_running', Status::YES);
        }
        $crons = $crons->get();
        foreach ($crons as $cron) {
            $cronLog = new CronJobLog();
            $cronLog->cron_job_id = $cron->id;
            $cronLog->start_at = now();
            if ($cron->is_default) {
                $controller = new $cron->action[0];
                try {
                    $method = $cron->action[1];
                    $controller->$method();
                } catch (\Exception $e) {
                    $cronLog->error = $e->getMessage();
                }
            } else {
                try {
                    CurlRequest::curlContent($cron->url);
                } catch (\Exception $e) {
                    $cronLog->error = $e->getMessage();
                }
            }
            $cron->last_run = now();
            $cron->next_run = now()->addSeconds($cron->schedule->interval);
            $cron->save();

            $cronLog->end_at = $cron->last_run;

            $startTime = Carbon::parse($cronLog->start_at);
            $endTime = Carbon::parse($cronLog->end_at);
            $diffInSeconds = $startTime->diffInSeconds($endTime);
            $cronLog->duration = $diffInSeconds;
            $cronLog->save();
        }
        if (request()->target == 'all') {
            $notify[] = ['success', 'Cron executed successfully'];
            return back()->withNotify($notify);
        }
        if (request()->alias) {
            $notify[] = ['success', keyToTitle(request()->alias) . ' executed successfully'];
            return back()->withNotify($notify);
        }
    }


    public function interest()
    {
        try {
            $now = Carbon::now();
            $invests = Invest::with(['user', 'project.time'])
                ->whereHas('project', function ($query) use ($now) {
                    $query->where('maturity_date', '<', $now);
                })
                ->running()
                ->where('next_time', '<=', $now)
                ->orderBy('last_time')
                ->take(100)
                ->get();

            foreach ($invests as $invest) {
                $this->processInvestment($invest, $now);
            }
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    private function processInvestment($invest, $now)
    {
        $project = $invest->project;
        $user = $invest->user;
        $hours = (int)$invest->project?->time->hours;
        $next = $now->addHours($hours)->toDateTimeString();

        // Process investment
        $invest->period += 1;
        $invest->paid += $invest->recuring_pay;
        $invest->next_time = $next;
        $invest->last_time = $now;

        // Update user's balance
        $user->balance += $invest->recuring_pay;
        $user->save();

        // Log the transaction
        $trx = getTrx();
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->invest_id = $invest->id;
        $transaction->amount = $invest->recuring_pay;
        $transaction->charge = 0;
        $transaction->post_balance = $user->balance;
        $transaction->trx_type = '+';
        $transaction->trx = $trx;
        $transaction->remark = 'profit';
        $transaction->details = showAmount($invest->recuring_pay) . ' profit from ' . @$invest->project->title;
        $transaction->save();

        // Check if the investment should be closed
        $this->checkInvestmentClosure($invest, $now);

        // Save the updated investment
        $invest->save();

        // Notify the user about the profit
        notify($user, 'INTEREST', [
            'trx' => $trx,
            'amount' => showAmount($invest->recuring_pay),
            'project_name' => @$invest->project->title,
            'post_balance' => showAmount($user->balance),
        ]);
    }

    private function checkInvestmentClosure($invest, $now)
    {
        if ($invest->return_type == Status::LIFETIME) {
            $matureDate = Carbon::now($invest->project->project_closed);

            if ($matureDate->lte($now)) {
                $invest->status = Status::INVEST_COMPLETED;
                if ($invest->capital_back == Status::CAPITAL_BACK && $invest->capital_status == Status::NO) {
                    Capital::capitalReturn($invest);
                }
            }
        } elseif ($invest->repeat_times == $invest->period) {
            $invest->status = Status::INVEST_COMPLETED;
            if ($invest->capital_status == Status::CAPITAL_BACK && $invest->capital_status == Status::NO) {
                Capital::capitalReturn($invest);
            }
        }
    }
}
