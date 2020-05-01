<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use App\User;
use Fcm\FcmClient;
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
        $questions =  Question::where('answer', 'option_5')->update(['answer' => 'option_4']);

        dd($questions);
    }
}
