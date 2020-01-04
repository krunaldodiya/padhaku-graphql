<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $categories = Category::all();

        $categories->map(function ($category) {
            Question::where('category_id', $category->id)->update(['category_id_uuid' => $category->uuid]);
        });
    }
}
