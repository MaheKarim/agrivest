<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Invest;
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
        $invest = Invest::findOrFail($id);

        return view('admin.invest.details', compact('pageTitle', 'invest'));
    }

    public function investStatus(Request $request, $id)
    {
        $invest = Invest::find($id);
        if ($invest->status == Status::INVEST_PENDING && $invest->payment_status == Status::INVEST_PAYMENT_PENDING) {
            $invest->status = Status::INVEST_CANCELED;
            $invest->payment_status = Status::PAYMENT_REJECT;
            $invest->save();
        } else {
            $invest->status = Status::INVEST_CANCELED;
            $invest->payment_status = Status::PAYMENT_REJECT;
            $invest->save();
        }
        $notify[] = ['success', 'Invest status change successfully.'];
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
}
