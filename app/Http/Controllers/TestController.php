<?php

namespace App\Http\Controllers;

use Error;

use App\Category;
use App\Quiz;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function test(Request $request, QuizRepositoryInterface $quizRepo)
    {
        $quiz_id = $request->quiz_id;
        $user = auth()->user();

        $timezone = 'Asia/Kolkata';
        $now = Carbon::now($timezone);

        $quiz = Quiz::with('quiz_infos', 'participants')->where('id', $quiz_id)->first();

        return $quiz->fresh();
    }
}
