<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quiz;
use App\Topic;
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

        Topic::create(['name' => "App\Quiz::{$quiz->id}"]);
    }
}
