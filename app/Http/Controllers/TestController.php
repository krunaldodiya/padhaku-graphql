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
        $users = User::get();

        foreach ($users as $user) {
            $public_topic = Topic::where(["name" => "user_all"])->first();
            $public_topic->subscribers()->attach($user);

            $private_topic = Topic::create(["name" => "user_{$user->id}"]);
            $private_topic->subscribers()->attach($user);
        }
        return "done";
    }
}
