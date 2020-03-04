<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function quizzes(Request $request)
    {
        $quizzes = Quiz::get();

        return response(['quizzes' => $quizzes], 200);
    }
}
