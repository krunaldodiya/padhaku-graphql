<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use KD\Wallet\Models\Transaction;
use KD\Wallet\Models\Wallet;

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

        $transactions = Transaction::query()
            ->where(['wallet_id' => $wallet->id, 'status' => 'success'])
            ->latest()
            ->get()
            ->map(function ($transaction) {
                $transaction['day'] = $transaction->created_at->format('d-m-Y');
                return $transaction;
            });

        return $transactions;
    }
}
