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
            'callback_url' => route('paytm-process-order')
        ]);

        return $payment->receive();
    }

    public function processOrder(Request $request)
    {
        $transaction = PaytmWallet::with('receive');

        $order = Order::with('user', 'plan')->find($transaction->getOrderId());

        $user = $order->user;

        $plan = $order->plan;

        if ($transaction->isSuccessful()) {
            $order->status = true;
            $order->save();

            $transaction = $user->createTransaction($plan->amount, 'deposit', [
                'points' => [
                    'id' => $user->id,
                    'type' => "Purchased Coins"
                ]
            ]);

            $user->deposit($transaction->transaction_id);

            return redirect('/paytm/order/success');
        }

        return redirect('/paytm/order/failed');
    }

    public function orderStatus(Request $request)
    {
        return $request->status;
    }
}
