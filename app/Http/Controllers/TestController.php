<?php

namespace App\Http\Controllers;

use Error;

use App\Category;
use App\Quiz;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function test(Request $request, QuizRepositoryInterface $quizRepo)
    {
        $checksum = getChecksumFromString(json_encode([
            'MID' => env('PAYTM_MERCHANT_ID'),
            'ORDERID' => '123456'
        ]), env('PAYTM_MERCHANT_KEY'));

        return compact('checksum');
    }
}
