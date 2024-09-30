<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Invest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class InvestReportController extends Controller
{
    public function index()
    {
        $pageTitle = 'Investment Statistics';

        $widget['total_invest'] = Transaction::where('remark', 'payment', 'wallet_payment')->sum('amount');
        $widget['profit_to_give'] = Invest::where('status', Status::INVEST_RUNNING)->where('period', '>', 0)->sum('recurring_pay');
        $widget['profit_paid'] = Invest::where('status', Status::INVEST_RUNNING)->where('period', '>', 0)->sum('paid');

        $interestByProjects = Invest::where('period', '>', 0)->selectRaw("SUM(paid) as total_price, project_id")->with('project')->groupBy('project_id')->orderBy('paid', 'desc')->get();
        $totalInterest = $interestByProjects->sum('total_price');

        $interestByProjects = $interestByProjects->mapWithKeys(function ($invest) {
            return [
                $invest->project->title => (float)$invest->total_price,
            ];
        });

        $recentInvests = Invest::with('project')->orderBy('id', 'desc')->limit(3)->get();
        $firstInvestYear = Invest::selectRaw("DATE_FORMAT(created_at, '%Y') as date")->first();

        return view('admin.reports.invest_statistics', compact('pageTitle', 'widget', 'interestByProjects', 'recentInvests', 'totalInterest', 'firstInvestYear'));
    }

    public function investStatistics(Request $request)
    {
        if ($request->time == 'year') {
            $time = now()->startOfYear();
            $prevTime = now()->startOfYear()->subYear();
        } elseif ($request->time == 'month') {
            $time = now()->startOfMonth();
            $prevTime = now()->startOfMonth()->subMonth();
        } else {
            $time = now()->startOfWeek();
            $prevTime = now()->startOfWeek()->subWeek();
        }

        $invests = Invest::where('created_at', '>=', $time)->selectRaw("SUM(total_price) as total_price, DATE_FORMAT(created_at, '%Y-%m-%d') as date")->groupBy('date')->get();
        $totalInvest = $invests->sum('total_price');

        $invests = $invests->mapWithKeys(function ($invest) {
            return [
                $invest->date => (float)$invest->total_price,
            ];
        });

        $prevInvest = Invest::where('created_at', '>=', $prevTime)->where('created_at', '<', $time)->sum('total_price');
        $investDiff = ($prevInvest ? $totalInvest / $prevInvest * 100 - 100 : 0);
        if ($investDiff > 0) {
            $upDown = 'up';
        } else {
            $upDown = 'down';
        }
        $investDiff = abs($investDiff);
        return [
            'invests' => $invests,
            'total_invest' => $totalInvest,
            'invest_diff' => round($investDiff, 2),
            'up_down' => $upDown,
        ];
    }

    public function investStatisticsByProject(Request $request)
    {
        if ($request->time == 'year') {
            $time = now()->startOfYear();
        } elseif ($request->time == 'month') {
            $time = now()->startOfMonth();
        } elseif ($request->time == 'week') {
            $time = now()->startOfWeek();
        } else {
            $time = date('0000-00-00 00:00:00');
        }

        $investChart = Invest::with('project')->where('created_at', '>=', $time)->groupBy('project_id')->selectRaw("SUM(total_price) as investAmount, project_id")->orderBy('investAmount', 'desc');
        if ($request->invest_type == 'active') {
            $investChart = $investChart->where('status', Status::INVEST_RUNNING);
        } elseif ($request->invest_type == 'closed') {
            $investChart = $investChart->where('status', Status::INVEST_CLOSED);
        }

        $investChart = $investChart->get();

        return [
            'invest_data' => $investChart,
            'total_invest' => $investChart->sum('investAmount'),
        ];
    }

    public function investInterestStatistics(Request $request)
    {
        if ($request->time == 'year') {
            $time = now()->startOfYear();
        } elseif ($request->time == 'month') {
            $time = now()->startOfMonth();
        } elseif ($request->time == 'week') {
            $time = now()->startOfWeek();
        } else {
            $time = date('0000-00-00 00:00:00');
        }

        $runningInvests = Invest::where('status', Status::INVEST_RUNNING)->where('created_at', '>=', $time)->sum('total_price');
        $expiredInvests = Invest::where('status', Status::INVEST_CLOSED)->where('created_at', '>=', $time)->sum('total_price');
        $interests = Transaction::where('remark', 'profit')->where('created_at', '>=', $time)->sum('amount');

        return [
            'running_invests' => showAmount($runningInvests),
            'expired_invests' => showAmount($expiredInvests),
            'interests' => showAmount($interests),
        ];
    }

    public function investInterestChart(Request $request)
    {
        $invests = Invest::whereYear('created_at', $request->year)->whereMonth('created_at', $request->month)->selectRaw("SUM(total_price) as total_price, DATE_FORMAT(created_at, '%d') as date")->groupBy('date')->get();

        $investsDate = $invests->map(function ($invest) {
            return $invest->date;
        })->toArray();

        $interests = Transaction::whereYear('created_at', $request->year)->whereMonth('created_at', $request->month)->where('remark', 'profit')->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at, '%d') as date")->groupBy('date')->get();

        $interestsDate = $interests->map(function ($interest) {
            return $interest->date;
        })->toArray();

        $dataDates = array_unique(array_merge($investsDate, $interestsDate));
        $investsData = [];
        $interestsData = [];
        foreach ($dataDates as $date) {
            $investsData[] = @$invests->where('date', $date)->first()->total_price ?? 0;
            $interestsData[] = @$interests->where('date', $date)->first()->total_price ?? 0;
        }

        return [
            'keys' => array_values($dataDates),
            'invests' => $investsData,
            'interests' => $interestsData,
        ];
    }
}
