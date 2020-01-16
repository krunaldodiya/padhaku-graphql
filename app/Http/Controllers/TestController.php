<?php

namespace App\Http\Controllers;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function paytmOrder(Request $request)
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

    public function paytmStatus(Request $request)
    {
        $transaction = PaytmWallet::with('receive');

        return $transaction->response();
    }
}
