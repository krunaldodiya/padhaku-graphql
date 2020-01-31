<?php

namespace App\Http\Controllers;

use App\Category;
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

    public function test(QuizRepositoryInterface $quizRepo)
    {
        $authUser = auth()->user();

        if ($authUser) {
            $quizRepo->generateQuiz(true);

            return 'done';
        }

        return 'not created';
    }
}
