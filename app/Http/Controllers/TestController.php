<?php

namespace App\Http\Controllers;

use App\Category;
use App\Topic;
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
        $user = User::first();
        $topic = Topic::first();

        $topic->subscribers()->attach($user);

        return "done";
    }
}
