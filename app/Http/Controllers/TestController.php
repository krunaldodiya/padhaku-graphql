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
        $checksum = verifychecksum_e([
            'MID' => env('PAYTM_MERCHANT_ID'),
            'ORDERID' => '128802ce-ed5f-4774-a7e1-7f8a4ff2867c'
        ], env('PAYTM_MERCHANT_KEY'), "i8QL7xRiMhmYKa3j+7foyTKKVNVyKinTf4YJvG6nKgn283I7kQIjgGBBknbrVg9fEHShALIAg0duvvDgY7pprD0k9ieYUYgzO18Xvg9cJRE=");

        // $checksum = getChecksumFromArray([
        //     'MID' => env('PAYTM_MERCHANT_ID'),
        //     'ORDERID' => '128802ce-ed5f-4774-a7e1-7f8a4ff2867c'
        // ], env('PAYTM_MERCHANT_KEY'));

        return compact('checksum');
    }
}
