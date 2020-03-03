<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invitation;
use App\Question;
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
        return Question::inRandomOrder()
            ->whereRaw('LENGTH(question) < 50')
            ->limit(50)
            ->get();
    }
}
