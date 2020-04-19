<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invitation;
use App\Player;
use App\Football;
use App\Religion;
use App\Question;
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
        app()->singleton("Hello", function () {
            return Str::random();
        });

        dump(resolve("Hello"));
        dump(resolve("Hello"));
    }
}
