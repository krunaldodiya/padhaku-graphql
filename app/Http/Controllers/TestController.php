<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quiz;
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

        return Quiz::with('questions')
            ->whereHas('participants', function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
