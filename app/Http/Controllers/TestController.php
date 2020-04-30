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

        if ($request->subscribe) {

            // $user = User::where('email', "kunal.dodiya1@gmail.com")->first();

            // foreach ($user->device_tokens as $device_token) {
            //     $client->topicSubscribe('testing', $device_token->token);
            // }

            $client->topicSubscribe("testing", "dKbQw6QfBEo:APA91bEMxB5vUhQkMaIAhyw9hwzOeHM3b1Jt24svjmD72TkDGmGyPvRd8fWn52DLu_wfwxDFercbHOibWoWNktmdu3Hkkv746E-VnSAUscOTmd_2rMCCT16iOiwgNJ_h0hsH_eoyaI4L");
        }

        if ($request->notify) {
            $client->pushNotification("testing", "test", "/topics/testing");
        }
    }
}
