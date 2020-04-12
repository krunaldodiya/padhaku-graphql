<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invitation;
use App\Question;
use App\User;
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
        $user = new User();

        dd($user);

        // return $user->quizzes()->whereIn("id", ["84ac6207-b793-4b05-90ee-c2367c30aec1"])->get();
    }
}
