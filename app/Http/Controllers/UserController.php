<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function upload(Request $request)
    {
        $user = auth()->user();

        $file = $request->file('image');

        $filename = "avatar.png";

        Storage::disk('public')->put($filename, $file);

        User::where('id', $user->id)->update(['avatar' => $filename]);

        return response(['status' => 'done'], 200);
    }
}
