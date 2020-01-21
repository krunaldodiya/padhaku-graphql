<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
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

        return Wallet::with('transactions')
            ->where('user_id', $user->id)
            ->whereHas('transactions', function ($query) {
                return $query
                    ->where('status', 'success')
                    ->orderBy('created_at', 'desc');
            })
            ->first();
    }
}
