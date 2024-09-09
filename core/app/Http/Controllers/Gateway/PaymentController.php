<?php

namespace App\Http\Controllers\Gateway;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\Invest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public static function userDataUpdate($deposit, $isManual = null)
    {
        if ($deposit->status == Status::PAYMENT_INITIATE || $deposit->status == Status::PAYMENT_PENDING) {
            $deposit->status = Status::PAYMENT_SUCCESS;
            $deposit->save();

            $user = User::find($deposit->user_id);
            if ($deposit->invest_id == 0) {
                $user->balance += $deposit->amount;
                $user->save();
            }

            $methodName = $deposit->methodName();

            $transaction = new Transaction();
            $transaction->user_id = $deposit->user_id;
            $transaction->amount = $deposit->amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = $deposit->charge;
            $transaction->trx_type = '+';
            if ($deposit->invest_id == 0) {
                $transaction->details = 'Deposit Via ' . $methodName;
                $transaction->remark = 'deposit';
            } else {
                $transaction->details = 'Payment Via ' . $methodName;
                $transaction->remark = 'payment';
            }
            $transaction->trx = $deposit->trx;
            $transaction->save();

            if (!$isManual) {
                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $user->id;
                $adminNotification->title = 'Deposit successful via ' . $methodName;
                $adminNotification->click_url = urlPath('admin.deposit.successful');
                $adminNotification->save();
            }

            notify($user, $isManual ? 'DEPOSIT_APPROVE' : 'DEPOSIT_COMPLETE', [
                'method_name' => $methodName,
                'method_currency' => $deposit->method_currency,
                'method_amount' => showAmount($deposit->final_amount, currencyFormat: false),
                'amount' => showAmount($deposit->amount, currencyFormat: false),
                'charge' => showAmount($deposit->charge, currencyFormat: false),
                'rate' => showAmount($deposit->rate, currencyFormat: false),
                'trx' => $deposit->trx,
                'post_balance' => showAmount($user->balance)
            ]);

            if ($deposit->invest_id != 0) {
                $invest = $deposit->invest;
                self::confirmOrder($invest, $deposit, $user);
            }
        }
    }

    public static function confirmOrder($invest, $deposit = null, $user = null)
    {
        $user = $invest->user;
        if (!$deposit || $deposit->invest_id == 0 || $invest->payment_type == Status::PAYMENT_WALLET) {
            $user->balance -= $invest->total_price;
            $user->save();
        }

        $project = $invest->project;
        $project->available_share -= $invest->quantity;
        $project->save();

        $methodName = $deposit ? $deposit->methodName() : 'Wallet';

        $transaction = new Transaction();
        $transaction->user_id = $invest->user_id;
        $transaction->amount = $invest->total_price;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '-';
        $transaction->trx = $deposit ? $deposit->trx : $invest->invest_no;
        if ($deposit && $deposit->invest_id != 0) {
            $transaction->details = 'Payment Via ' . $methodName;
            $transaction->remark = 'payment';
        } elseif ($deposit && $deposit->invest_id == 0) {
            $transaction->details = 'Deposit Via ' . $methodName;
            $transaction->remark = 'deposit';
        } else {
            $transaction->details = 'Payment Via Wallet';
            $transaction->remark = 'wallet_payment';
        }
        $transaction->save();

        notify($invest->user, 'ORDER_CONFIRMED', [
            'trx' => $transaction->trx,
            'order_number' => $invest->id,
            'event_name' => $invest->project->title,
            'start_date' => $invest->project->start_date,
            'end_date' => $invest->project->end_date,
            'price' => showAmount($invest->price),
            'quantity' => $invest->quantity,
            'total_price' => showAmount($invest->total_price),
        ]);

        $invest->payment_status = Status::PAYMENT_SUCCESS;
        $invest->status = Status::INVEST_RUNNING;
        $invest->save();
    }

    public function deposit(Request $request, $investId = 0)
    {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->with('method')->orderby('name')->get();
        $pageTitle = 'Deposit Methods';
        $invest = null;

        if ($investId) {
            $pageTitle = 'Payment Methods';
            $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
                $gate->where('status', Status::ENABLE);
            })->with('method')->orderby('name')->get();
            $invest = Invest::where('id', $investId)->where('user_id', auth()->id())->where('payment_status', Status::PAYMENT_INITIATE)->first();

            if (!$invest) {
                $notify[] = ['error', 'You can not make payment for this order'];
                return to_route('user.home')->withNotify($notify);
            }
        }
        return view('Template::user.payment.deposit', compact('gatewayCurrency', 'pageTitle', 'invest'));
    }

    public function depositInsert(Request $request, $investId = 0)
    {
        $isRequired = $investId && $request->gateway == "2" ? 'nullable' : 'required';
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'gateway' => 'required',
            'currency' => $isRequired,
        ]);

        $user = auth()->user();
        if ($investId) {
            $invest = Invest::where('user_id', auth()->id())->where('payment_status', Status::PAYMENT_INITIATE)->firstOrFail();
            $gate = GatewayCurrency::whereHas('method', function ($gate) {
                $gate->where('status', Status::ENABLE);
            })->where('method_code', $request->gateway)->where('currency', $request->currency)->first();
            if ($gate->min_amount > $invest->total_price || $gate->max_amount < $invest->total_price) {
                $notify[] = ['error', 'Please follow deposit limit'];
                return back()->withNotify($notify);
            }
        }

        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->where('method_code', $request->gateway)->where('currency', $request->currency)->first();
        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = ['error', 'Please follow deposit limit'];
            return back()->withNotify($notify);
        }

        $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
        $payable = $request->amount + $charge;
        $finalAmount = $payable * $gate->rate;

        $data = new Deposit();
        $data->user_id = $user->id;
        $data->invest_id = $investId ?? 0;
        $data->method_code = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        if ($investId) {
            $data->amount = $invest->total_price;
        } else {
            $data->amount = $request->amount;
        }
        $data->charge = $charge;
        $data->rate = $gate->rate;
        $data->final_amount = $finalAmount;
        $data->btc_amount = 0;
        $data->btc_wallet = "";

        $data->trx = $investId ? $invest->invest_no : getTrx();

        $data->success_url = urlPath('user.deposit.history');
        $data->failed_url = urlPath('user.deposit.history');
        $data->save();
        session()->put('Track', $data->trx);
        return to_route('user.deposit.confirm');
    }

    public function depositConfirm()
    {
        $track = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status', Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();
        if (!$deposit) {
            $notify[] = ['error', 'Invalid request'];
            return back()->withNotify($notify);
        }
        if ($deposit->method_code >= 1000) {
            return to_route('user.deposit.manual.confirm');
        }


        $dirName = $deposit->gateway->alias;
        $new = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);


        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return back()->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if (@$data->session) {
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view("Template::$data->view", compact('data', 'pageTitle', 'deposit'));
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        abort_if(!$data, 404);
        if ($data->method_code > 999) {
            $pageTitle = 'Confirm Deposit';
            $method = $data->gatewayCurrency();
            $gateway = $method->method;
            return view('Template::user.payment.manual', compact('data', 'pageTitle', 'method', 'gateway'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        abort_if(!$data, 404);
        $gatewayCurrency = $data->gatewayCurrency();
        $gateway = $gatewayCurrency->method;
        $formData = $gateway->form->form_data;

        $formProcessor = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);


        $data->detail = $userData;
        $data->status = Status::PAYMENT_PENDING;
        $data->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $data->user->id;
        $adminNotification->title = 'Deposit request from ' . $data->user->username;
        $adminNotification->click_url = urlPath('admin.deposit.details', $data->id);
        $adminNotification->save();

        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name' => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount' => showAmount($data->final_amount, currencyFormat: false),
            'amount' => showAmount($data->amount, currencyFormat: false),
            'charge' => showAmount($data->charge, currencyFormat: false),
            'rate' => showAmount($data->rate, currencyFormat: false),
            'trx' => $data->trx
        ]);

        $notify[] = ['success', 'You have deposit request has been taken'];
        return to_route('user.deposit.history')->withNotify($notify);
    }

}
