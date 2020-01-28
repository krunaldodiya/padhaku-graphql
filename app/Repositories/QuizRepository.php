<?php

namespace App\Repositories;

use App\Events\QuizGenerated;
use App\Quiz;
use App\Question;
use App\QuizInfo;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QuizRepository implements QuizRepositoryInterface
{
    public function cancelQuiz($quiz)
    {
        DB::table('quiz_particiants')->where('quiz_id', $quiz->id)->update(['status' => 'canceled']);
        Quiz::where('id', $quiz->id)->update(['status' => 'canceled']);

        $quiz->participants->each(function ($user) {
            // wallet
        });
    }

    public function generateQuiz()
    {
        $from = Carbon::parse('today 7am');
        $to = Carbon::parse('today 10pm');

        $quizInfo = QuizInfo::where('entry_fee', 10)->first();

        if (now()->gte($from) && now()->lte($to)) {
            $expired_at = now()->addHour($quizInfo->expiry);

            $quiz = Quiz::create([
                'quiz_info_id' => $quizInfo->id,
                'expired_at' => $expired_at,
                'created_at' => now(),
                'updated_at' => now(),
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

            event(new QuizGenerated($quiz));
        }
    }
}
