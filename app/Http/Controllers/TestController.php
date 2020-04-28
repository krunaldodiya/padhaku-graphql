<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invitation;
use App\Player;
use App\Football;
use App\Religion;
use App\Question;
use App\Quiz;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function test(Request $request)
    {
        $quiz = Quiz::all();

        $list = [];

        foreach ($quiz as $item) {
            $list[$item->id] = $item->id;
        }

        return $list;
    }
}
