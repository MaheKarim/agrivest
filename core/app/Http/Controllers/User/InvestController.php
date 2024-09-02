<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
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

       $project = Project::find($request->project_id);

        if ($request->quantity > $project->available_share) {
            $notify[] = ['error', 'Not enough shares available.'];
            return back()->withNotify($notify);
        }

        $unitPrice = $project->share_amount;
        $totalPrice = $unitPrice * $request->quantity;
        $totalEarning = ($request->quantity * ($project->share_amount + $project->roi_amount));
        $totalShare = $project->share_count;

        $invest = new Invest();
        $invest->user_id = auth()->id();
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
        $notify[] = ['success', 'Investment has been placed successfully'];
        return redirect()->route('user.home')->withNotify($notify);
    }
}
