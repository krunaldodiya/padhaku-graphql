<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function upload(Request $request)
    {
        dump($request->file('image'));

        return 'done';
    }
}
