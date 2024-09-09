<?php

namespace App\Lib;

use App\Constants\Status;
use App\Models\Transaction;

class Capital
{
    public static function capitalReturn($invest)
    {
        $user = $invest->user;
        $user->balance += $invest->total_price;
        $user->save();

        $invest->capital_back = Status::CAPITAL_BACK;
        $invest->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->invest_id = $invest->id;
        $transaction->amount = $invest->total_price;
        $transaction->charge = 0;
        $transaction->post_balance = $user->balance;
        $transaction->trx_type = '+';
        $transaction->trx = getTrx();
        $transaction->remark = 'capital_return';
        $transaction->details = showAmount($invest->amount) . ' capital back from ' . @$invest->project->title;
        $transaction->save();
    }
}
