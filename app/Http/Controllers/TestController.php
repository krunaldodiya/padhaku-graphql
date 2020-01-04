<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;

use App\Question;
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
        $page = $request->page;

        $questions = DB::table('questions_old')->paginate(1000, ['*'], 'page', $page)->toArray();

        foreach ($questions['data'] as $question) {
            Question::create([
                'question' => $question->question,
                'category_id' => $question->category_id,
                'question_hindi' => $question->question_hindi,
                'image' => $question->image,
                'option_1' => $question->option_1,
                'option_2' => $question->option_2,
                'option_3' => $question->option_3,
                'option_4' => $question->option_4,
                'option_1_hindi' => $question->option_1_hindi,
                'option_2_hindi' => $question->option_2_hindi,
                'option_3_hindi' => $question->option_3_hindi,
                'option_4_hindi' => $question->option_4_hindi,
                'answer' => $question->answer,
            ]);
        }

        if ($questions['next_page_url']) {
            return $questions['next_page_url'];
        }
    }
}
