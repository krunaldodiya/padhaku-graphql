<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\TestJob;
use App\Quiz;
use App\User;
use Illuminate\Http\Request;
use KD\Wallet\Models\Wallet;

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

        TestJob::dispatch($user)->delay(now()->addSeconds(5));
    }
}
