<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function test(Request $request)
    {
        try {
            DB::statement("ALTER TABLE quizzes MODIFY COLUMN status ENUM('pending', 'finished', 'started', 'suspended', 'full')");

            return 'done';
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
