<?php

namespace App\Http\Controllers;

use App\Category;
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
        $quiz_data = Quiz::with('participants', 'quiz_infos')->find($request->quiz_id);

        return $quiz_data->participants()->where('quiz_status', 'started')->count();
    }
}
