<?php

namespace App\Traits;

use App\Constants\Status;
use App\Models\Transaction;

trait OrderConfirmation
{
    protected static function transactionCreate($invest, $user, $deposit)
    {
        $invest->payment_status = Status::PAYMENT_SUCCESS;
        $invest->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $invest->total_price;
        $transaction->charge = $deposit->charge;
        $transaction->trx_type = '-';
        $transaction->details = 'Order confirmation via ' . $deposit->gatewayCurrency()->name;
        $transaction->trx = $invest->order_no;
        $transaction->remark = 'Payment';
        $transaction->save();

        notify($user, 'PAYMENT_COMPLETE', [
            'user_name' => $user->username,
            'total' => showAmount($invest->total_price, currencyFormat: false),
            'currency' => gs('cur_text'),
            'method' => $deposit->gatewayCurrency()->name,
            'charge' => showAmount($deposit->charge, currencyFormat: false),
        ]);
    }

    public function orderConfirm($order)
    {
        $notify[] = ['success', 'Order has been placed.'];


        return redirect()->route('user.order.details', $order->id)->withNotify($notify);

    }

}
