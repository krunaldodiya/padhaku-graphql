<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Fcm\FcmClient;
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
        $client = new FcmClient(env('FIREBASE_SERVER_KEY'), env('FIREBASE_SENDER_ID'));

        $user = User::where('email', "kunal.dodiya1@gmail.com")->first();

        foreach ($user->device_tokens as $device_token) {
            $client->topicSubscribe('testing', $device_token->token);
        }

        dd($user->device_tokens);
    }
}
