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
        $totalEarning = ($request->quantity * ($project->share_amount + $project->roi_amount));
        $totalShare = $project->share_count;

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
        $invest->save();

        if ($request->payment_type == Status::PAYMENT_ONLINE) {
            return redirect()->route('user.deposit.index', $invest->id);
        }

        if ($request->payment_type == Status::PAYMENT_WALLET) {
            // Wallet Payment
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
