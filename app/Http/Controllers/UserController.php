<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function upload(Request $request)
    {
        dd($request->file('image'));
    }
}
