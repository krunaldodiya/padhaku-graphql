<?php

namespace App\Http\Controllers;

use App\Category;
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
        $quiz = Quiz::first();

        dd($quiz);
    }
}
