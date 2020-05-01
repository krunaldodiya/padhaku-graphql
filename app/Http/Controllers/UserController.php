<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function upload(Request $request)
    {
        $user = auth()->user();

        $file = $request->file('image');

        $filename = $file->store($user->id, 'public');

        User::where('id', $user->id)->update(['avatar' => $filename]);

        return response(['filename' => $filename], 200);
    }

    public function checkInvitation(Request $request)
    {
        $sender_id = $request->segment(3);
        $mobile = $request->segment(4);

        $exists = Invitation::where(['mobile' => $mobile])->first();

        if (!$exists) {
            Invitation::create([
                'sender_id' => $sender_id,
                'mobile' => $mobile
            ]);
        }

        return redirect("https://www.sawalbemisaal.com");
    }

    public function rate(Request $request)
    {
        return redirect("https://play.google.com/store/apps/details?id=com.sawaalbemisaal.org");
    }
}
