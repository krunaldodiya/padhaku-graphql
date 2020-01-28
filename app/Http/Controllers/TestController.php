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
        $quiz_data = Quiz::with('participants', 'quiz_infos')->first();

        $minimum_participants = $quiz_data->participants()->count() >= $quiz_data->quiz_infos->total_participants;
        $minimum_winners = $quiz_data->participants()->where('quiz_status', 'started')->count() >= $quiz_data->quiz_infos->total_winners;

        return compact('minimum_participants', 'minimum_winners');
    }
}
