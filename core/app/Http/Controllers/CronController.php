<?php

namespace App\Http\Controllers;

use App\Constants\Status;
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
        $general            = gs();
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
            $cronLog              = new CronJobLog();
            $cronLog->cron_job_id = $cron->id;
            $cronLog->start_at    = now();
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

            $startTime         = Carbon::parse($cronLog->start_at);
            $endTime           = Carbon::parse($cronLog->end_at);
            $diffInSeconds     = $startTime->diffInSeconds($endTime);
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
                ->whereHas('project')
                ->running() //status running
                ->where('next_time', '<=', $now)
                ->orderBy('last_time')
                ->take(100)
                ->get();

            dump($invests);
            foreach ($invests as $invest) {
                // dd(getTotalReturns($invest) <= $invest->period);

                // 4 <= 3
                // 4 = 4
                // 4 <= 5
                // 4 <= 6

                $this->processInvestment($invest, $now);
            }
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    private function processInvestment($invest, $now)
    {
        $user    = $invest->user;
        $hours   = (int)$invest->project?->time->hours;
        $next    = $now->addHours($hours)->toDateTimeString();

        // Process investment
        $invest->period   += 1;
        $invest->paid     += $invest->recurring_pay;
        $invest->next_time = $next;
        $invest->last_time = $now;

        // dd(getTotalReturns($invest) <= $invest->period);

        // Update user's balance
        $user->balance += $invest->recurring_pay;
        $user->save();

        // Log the transaction
        $trx                       = getTrx();
        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->invest_id    = $invest->id;
        $transaction->amount       = $invest->recurring_pay;
        $transaction->charge       = 0;
        $transaction->post_balance = $user->balance;
        $transaction->trx_type     = '+';
        $transaction->trx          = $trx;
        $transaction->remark       = 'profit';
        $transaction->details      = showAmount($invest->recurring_pay) . ' profit from ' . @$invest->project->title;
        $transaction->save();

        // Check if the investment should be closed
        $this->checkInvestmentClosure($invest, $now);

        // Save the updated investment
        $invest->save();

        // Notify the user about the profit
        notify($user, 'INTEREST', [
            'trx'          => $trx,
            'amount'       => showAmount($invest->recurring_pay),
            'project_name' => @$invest->project->title,
            'post_balance' => showAmount($user->balance),
        ]);
    }

    private function checkInvestmentClosure($invest, $now)
    {
        if ($invest->return_type == Status::LIFETIME) {
            if (getTotalReturns($invest) <= $invest->period) {
                $invest->status = Status::INVEST_COMPLETED;
                $invest->save();

                $this->capitalReturn($invest);
            }
        } elseif ($invest->repeat_times == $invest->period) {
            $invest->status = Status::INVEST_COMPLETED;
            $this->capitalReturn($invest);
        }
    }

    private function capitalReturn($invest)
    {
        if ($invest->capital_back == Status::CAPITAL_BACK && $invest->capital_status == Status::NO) {
            $user           = $invest->user;
            $user->balance += $invest->total_price;
            $user->save();

            $invest->capital_status = Status::YES;
            $invest->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->invest_id    = $invest->id;
            $transaction->amount       = $invest->total_price;
            $transaction->charge       = 0;
            $transaction->post_balance = $user->balance;
            $transaction->trx_type     = '+';
            $transaction->trx          = getTrx();
            $transaction->remark       = 'capital_return';
            $transaction->details      = showAmount($invest->total_price) . ' capital back from ' . @$invest->project->title;
            $transaction->save();
        }
    }
}
