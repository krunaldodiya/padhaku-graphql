<?php

namespace App\Http\Controllers;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Order;
use Illuminate\Http\Request;

class PaytmController extends Controller
{
    public function createOrder(Request $request)
    {
        $order = Order::with('user', 'plan')->find($request->order_id);

        $payment = PaytmWallet::with('receive');

        $payment->prepare([
            'order' => $order->id,
            'user' => $order->user->id,
            'mobile_number' => $order->user->mobile,
            'email' => $order->user->email,
            'amount' => $order->plan->amount,
            'callback_url' => route('paytm-status')
        ]);

        return $payment->receive();
    }

    public function checkStatus(Request $request)
    {
        $transaction = PaytmWallet::with('receive');

        $order = Order::with('user', 'plan')->find($transaction->getOrderId());

        dd($order);

        // if ($transaction->isSuccessful()) {
        //     $transaction = $user->createTransaction($transaction->TXNAMOUNT, 'deposit', [
        //         'points' => [
        //             'id' => $user->id,
        //             'type' => "Purchased Coins"
        //         ]
        //     ]);

        //     $user->deposit($transaction->transaction_id);
        // }

        return $transaction->response();
    }
}
