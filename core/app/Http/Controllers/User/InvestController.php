<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Models\Invest;
use App\Models\Project;
use Illuminate\Http\Request;

class InvestController extends Controller
{

    public function order(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'quantity' => 'required|integer|min:1',
            'payment_type' => 'required|in:1,2',
        ]);
        $user = auth()->user();
        $project = Project::find($request->project_id);
        if (!$project) {
            $notify[] = ['error', 'Project not found.'];
            return back()->withNotify($notify);
        }

        if ($request->quantity > $project->available_share) {
            $notify[] = ['error', 'Not enough shares available.'];
            return back()->withNotify($notify);
        }

        $unitPrice = $project->share_amount;
        $totalPrice = $unitPrice * $request->quantity;
        $totalEarning = ($request->quantity * $project->roi_amount);
        $totalShare = $project->share_count;
        $recuringAmount = $totalEarning / $project->repeat_times;

        $invest = new Invest();
        $invest->invest_no = getTrx();
        $invest->user_id = $user->id;
        $invest->project_id = $request->project_id;
        $invest->quantity = $request->quantity;
        $invest->unit_price = $unitPrice;
        $invest->total_price = $totalPrice;
        $invest->roi_percentage = $project->roi_percentage;
        $invest->roi_amount = $project->roi_amount;
        $invest->payment_type = $request->payment_type;
        $invest->total_earning = $totalEarning;
        $invest->total_share = $totalShare;
        $invest->capital_back = $project->capital_back;
        $invest->capital_status = Status::NO;
        $invest->return_type = $project->return_type;
        $invest->repeat_times = $project->repeat_times;
        $invest->return_interval = $project->return_interval;
        $invest->time_name = $project->time->name;
        $invest->hours = $project->time->hours;
        $invest->recuring_pay = $recuringAmount;
        $invest->save();

        if ($request->payment_type == Status::PAYMENT_ONLINE) {
            return redirect()->route('user.deposit.index', $invest->id);
        }

        // Wallet Payment
        if ($request->payment_type == Status::PAYMENT_WALLET) {
            if ($totalPrice > $user->balance) {
                $notify[] = ['error', 'Insufficient balance.'];
                return back()->withNotify($notify);
            }

            PaymentController::confirmOrder($invest);
            $notify[] = ['success', 'Investment successful using wallet balance.'];
            return redirect()->route('user.home')->withNotify($notify);
        }

        return redirect()->route('user.home',);
    }
}
