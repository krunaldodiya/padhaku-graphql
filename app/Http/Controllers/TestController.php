<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\SendQuizNotification;
use App\Quiz;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function test(QuizRepositoryInterface $quizRepository)
    {
        $quiz = Quiz::first();
        // SendQuizNotification::dispatch($quiz);

        try {
            $quizRepository->notify("public", [
                'title' => 'Reminder', 'body' => 'Quiz will start in 15 minutes'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
