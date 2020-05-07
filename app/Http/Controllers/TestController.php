<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quiz;
use App\User;
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
        $user = User::where(['username' => 'abhijits'])->first();

        return Quiz::with('quiz_infos', 'participants', 'questions')
            ->whereHas('participants', function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->orderBy("expired_at", "DESC")
            ->limit(10)
            ->get();
    }
}
