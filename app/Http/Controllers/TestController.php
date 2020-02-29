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
        $invitation = Invitation::with('sender')
            ->where(['mobile' => $request->mobile])
            ->first();

        return $invitation;
    }
}
