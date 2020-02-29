<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invitation;
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
        $points = config('points.invitation');

        dd($points);
    }
}
