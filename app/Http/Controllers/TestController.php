<?php

namespace App\Http\Controllers;

use App\Category;
use App\ReferSource;
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
        $refer_source_id = $request->session()->has('utm_id') ? $request->session()->get('utm_id') : ReferSource::first()->id;
        dd($refer_source_id);

        return "done";
    }
}
