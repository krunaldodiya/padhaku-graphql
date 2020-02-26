<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\Jobs\SendQuizNotification;
use App\Quiz;
use App\Repositories\Contracts\QuizRepositoryInterface;
use App\Repositories\OtpRepositoryInterface;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function test(Request $request, OtpRepositoryInterface $otpRepository)
    {
        dd(url('images/icon.png'));
    }
}
