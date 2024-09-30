<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Invest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ManageInvestController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Investments';
        $invests = Invest::latest()->searchable(['invest_no'])->paginate(getPaginate());

        return view('admin.invest.index', compact('pageTitle', 'invests'));
    }

    public function details($id)
    {
        $pageTitle = 'Invest Details';
        $invest = Invest::with('user', 'project')->findOrFail($id);
        $transactions = Transaction::where('invest_id', $invest->id)->orderBy('id', 'desc')->paginate(getPaginate());

        return view('admin.invest.details', compact('pageTitle', 'invest', 'transactions'));
    }

    public function investStatus($id)
    {
        $invest = Invest::where('status', Status::INVEST_PENDING)
            ->where('payment_status', Status::INVEST_PAYMENT_PENDING)
            ->findOrFail($id);

        $invest->status = Status::INVEST_CANCELED;
        $invest->payment_status = Status::PAYMENT_REJECT;
        $invest->save();

        notify($invest->user, 'INVEST_REJECTED', [
            'invest_id' => $invest->invest_no,
            'project_title' => $invest->project->title,
            'invest_amount' => showAmount($invest->total_price, currencyFormat: false),
            'quantity' => $invest->quantity,
        ]);

        $notify[] = ['success', 'Invest cancelled successfully.'];
        return back()->withNotify($notify);
    }


    public function runningInvest()
    {
        $pageTitle = 'Running Investments';
        $invests = $this->investData('running');

        return view('admin.invest.index', compact('pageTitle', 'invests'));
    }

    protected function investData($scope = null)
    {
        if ($scope) {
            $users = Invest::$scope();
        } else {
            $users = Invest::query();
        }
        return $users->searchable(['invest_id'])->orderBy('id', 'desc')->paginate(getPaginate());
    }

    public function stopReturns($id)
    {
        $invest = Invest::where('id', $id)
            ->where('status', Status::INVEST_RUNNING)
            ->whereHas('project', function ($query) {
                $query->where('return_type', Status::LIFETIME);
            })
            ->firstOrFail();

        $invest->status = Status::INVEST_CLOSED;
        $invest->save();

        $notify[] = ['success', 'Returns have been stopped successfully.'];
        return back()->withNotify($notify);
    }

    public function startReturns($id)
    {
        $invest = Invest::where('id', $id)
            ->where('status', Status::INVEST_CLOSED)
            ->whereHas('project', function ($query) {
                $query->where('return_type', Status::LIFETIME);
            })
            ->firstOrFail();

        $invest->status = Status::INVEST_RUNNING;
        $invest->save();

        $notify[] = ['success', 'Returns have been started successfully.'];
        return back()->withNotify($notify);
    }
}
