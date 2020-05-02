<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quiz;
use App\Topic;
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
        $quizzes = Quiz::query()
            ->whereDate('created_at', "=", Carbon::today())
            ->whereDate('expired_at', '<=', "2020-05-02 16:50:00")
            ->get();

        foreach ($quizzes as $quiz) {
            Topic::query()
                ->where('name', "quiz_reminder_{$quiz->id}")
                ->delete();
        }

        return "done";
    }
}
