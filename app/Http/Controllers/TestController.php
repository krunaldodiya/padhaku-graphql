<?php

namespace App\Http\Controllers;

use App\Category;
use App\QuizInfo;
use App\User;
use Carbon\Carbon;
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
        $quizInfo = QuizInfo::where('entry_fee', 10)->first();
        $expired_at = now()->addHour($quizInfo->expiry);
        dd($expired_at, now());
    }
}
