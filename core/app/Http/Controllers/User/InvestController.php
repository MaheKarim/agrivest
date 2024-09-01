<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invest;
use Illuminate\Http\Request;

class InvestController extends Controller
{
    public function order(Request $request)
    {
        $invest = new Invest();
        $invest->user_id = auth()->id();
        $invest->project_id = $request->project_id;
        $invest->amount = $request->amount;
        $invest->quantity = $request->quantity;
        $invest->save();

        return redirect()->route('user.home')->with('success', 'Investment has been placed successfully');
    }
}
