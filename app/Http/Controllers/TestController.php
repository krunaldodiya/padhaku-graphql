<?php

namespace App\Http\Controllers;

use App\Category;
use App\Transaction;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function test(Request $request)
    {
        $user = User::first();

        $wallet = Wallet::where(['user_id' => $user->id])->first();

        $wallet['transactions'] = Transaction::query()
            ->where(['wallet_id' => $wallet->id, 'status' => 'success'])
            ->orderBy('created_at', 'desc')
            ->get();

        return $wallet;
    }
}
