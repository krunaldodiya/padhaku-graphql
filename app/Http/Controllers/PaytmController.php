<?php

namespace App\Http\Controllers;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use Illuminate\Http\Request;

class PaytmController extends Controller
{
    public function createOrder(Request $request)
    {
        $paytm_status = route('paytm-status');

        $payment = PaytmWallet::with('receive');

        $data = $request->all();

        $payment->prepare([
            'order' => $data['order_id'],
            'user' => $data['user_id'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['email'],
            'amount' => $data['amount'],
            'callback_url' => $paytm_status
        ]);

        return $payment->receive();
    }

    public function checkStatus(Request $request)
    {
        $transaction = PaytmWallet::with('receive');

        return $transaction->response();
    }
}
