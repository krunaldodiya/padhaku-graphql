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
        $data = [
            "mode" => "Staging",
            "MID" => "dBhsxy51569465348988",
            "ORDER_ID" => "30698f4a-7d7f-42af-b9f5-2cf05b90df88",
            "CALLBACK_URL" => "https://securegw.paytm.in/theia/paytmCallback?ORDER_ID=30698f4a-7d7f-42af-b9f5-2cf05b90df88",
            "CHANNEL_ID" => "WAP",
            "CUST_ID" => "11baadeb-09c4-4b2d-8558-37695dd98756",
            "INDUSTRY_TYPE_ID" => "Retail",
            "TXN_AMOUNT" => "10",
            "MOBILE_NO" => "9426726815",
            "EMAIL" => "kunal.dodiya1@gmail.com",
            "WEBSITE" => "WEBSTAGING"
        ];

        if ($request->type === "verify") {
            $verify = verifychecksum_e($data, env('PAYTM_MERCHANT_KEY'), $request->checksum_verify);
            return compact('verify');
        }

        $generate = getChecksumFromArray($data, env('PAYTM_MERCHANT_KEY'));
        return compact('generate');
    }
}
