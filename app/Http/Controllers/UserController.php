<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function upload(Request $request)
    {
        $user = auth()->user();

        $file = $request->file('image');

        $filename = $file->store($user->id);

        User::where('id', $user->id)->update(['avatar' => $filename]);

        return response(['status' => 'done'], 200);
    }
}
