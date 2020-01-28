<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\TestQuizStatus;
use App\Quiz;
use App\QuizInfo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nuwave\Lighthouse\Execution\Utils\Subscription;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function test(Request $request)
    {
        $quiz = Quiz::first();

        TestQuizStatus::dispatch($quiz)->delay(now()->addSeconds(10));

        return 'done';
    }
}
