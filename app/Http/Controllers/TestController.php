<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quiz;
use App\Topic;
use Carbon\Carbon;
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
        return "done";
    }
}
