<?php

namespace App\Repositories;

use App\Quiz;
use App\Question;
use App\QuizInfo;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Carbon\Carbon;

class QuizRepository implements QuizRepositoryInterface
{
    public function generateQuiz()
    {
        $now = Carbon::now();

        $from = Carbon::parse('today 7am');
        $to = Carbon::parse('today 10pm');

        $quizInfo = QuizInfo::where('entry_fee', 10)->first();

        if ($now->gte($from) && $now->lte($to)) {
            $expired_at = $now->addHour($quizInfo->expiry);

            $all_questions = Question::inRandomOrder()
                ->limit($quizInfo->all_questions_count)
                ->get();

            $answerable_question_ids = array_rand($all_questions->toArray(), $quizInfo->answerable_questions_count);

            $answerable_questions = collect($answerable_question_ids)
                ->map(function ($answerable_question_id) use ($all_questions) {
                    return $all_questions[$answerable_question_id];
                })
                ->toArray();

            return Quiz::create([
                'all_questions_meta' => json_encode($all_questions),
                'answerable_questions_meta' => json_encode($answerable_questions),
                'quiz_info_id' => $quizInfo->id,
                'expired_at' => $expired_at,
            ]);
        }
    }
}
