<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\CalculateRanking;
use App\Quiz;
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
        if ($request->quiz_id) {
            $quiz = Quiz::with('quiz_infos')->find($request->quiz_id);

            CalculateRanking::dispatch($quiz)->delay(now()->addSeconds(5));

            return 'done';
        }

        return ['error' => 'invalid quiz'];
    }
}
