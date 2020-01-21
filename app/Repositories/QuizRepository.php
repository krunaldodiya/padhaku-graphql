<?php

namespace App\Repositories;

use App\Jobs\CalculateRanking;
use App\Quiz;
use App\Question;
use App\QuizInfo;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QuizRepository implements QuizRepositoryInterface
{
    public function generateQuiz()
    {
        $timezone = 'Asia/Kolkata';
        $now = Carbon::now($timezone);

        $from = Carbon::parse('today 7am', $timezone);
        $to = Carbon::parse('today 10pm', $timezone);

        $quizInfo = QuizInfo::where('entry_fee', 10)->first();

        if ($now->gte($from) && $now->lte($to)) {
            $expired_at = $now->addHour($quizInfo->expiry);

            $quiz = Quiz::create([
                'quiz_info_id' => $quizInfo->id,
                'expired_at' => $expired_at,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $all_questions = Question::inRandomOrder()
                ->limit($quizInfo->all_questions_count)
                ->pluck('id')
                ->toArray();

            $answerable_questions = collect(array_rand($all_questions, $quizInfo->answerable_questions_count))
                ->map(function ($answerable_question_index) use ($all_questions) {
                    return $all_questions[$answerable_question_index];
                })
                ->toArray();

            $quiz->questions()->attach($all_questions);

            DB::table("quiz_questions")
                ->where(['quiz_id' => $quiz->id])
                ->whereIn('question_id', $answerable_questions)
                ->update(['is_answerable' => true]);

            CalculateRanking::dispatch($quiz)->delay(now()->addSeconds(5));

            // CalculateRanking::dispatch($quiz)->delay($expired_at);
        }
    }
}
