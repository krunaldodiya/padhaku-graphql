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
        $checksum_verify = "OmVfj0nkFfMq8Sy6yXq8sihW+Mtuc/Aar7+KWpW6q9KwYJRoyh+44Jf3KS5ko6y00W/XjtB4Nxtt89/Va/eipxCHBIDRF3TrmDGGnoOmxas=";

        $checksum = verifychecksum_e([
            'MID' => env('PAYTM_MERCHANT_ID'),
            'ORDERID' => '128802ce-ed5f-4774-a7e1-7f8a4ff2867c'
        ], env('PAYTM_MERCHANT_KEY'), $checksum_verify);

        // $checksum = getChecksumFromArray([
        //     'MID' => env('PAYTM_MERCHANT_ID'),
        //     'ORDERID' => '128802ce-ed5f-4774-a7e1-7f8a4ff2867c'
        // ], env('PAYTM_MERCHANT_KEY'));

        return compact('checksum');
    }
}
