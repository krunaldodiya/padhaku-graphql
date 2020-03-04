<?php

namespace App\Repositories;

use App\Events\QuizGenerated;
use App\Quiz;
use App\Question;
use App\QuizInfo;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class QuizRepository implements QuizRepositoryInterface
{
    public function cancelQuiz($quiz)
    {
        DB::table('quiz_participants')->where('quiz_id', $quiz->id)->update(['quiz_status' => 'canceled']);

        $quiz->participants->each(function ($user) use ($quiz) {
            $transaction = $user->createTransaction($quiz->quiz_infos->entry_fee, 'deposit', [
                'points' => [
                    'id' => $user->id,
                    'type' => "Quiz Canceled"
                ]
            ]);

            $user->deposit($transaction->transaction_id);
        });

        Quiz::where('id', $quiz->id)->update(['status' => 'canceled']);
    }

    public function generateQuiz($forceGenerate, $quizInfoId)
    {
        $from = Carbon::parse('today 9am');
        $to = Carbon::parse('today 9pm');

        $quizInfo = QuizInfo::where('id', $quizInfoId)->first();
        $validTime = now()->gte($from) && now()->lte($to);

        if (!$forceGenerate && !$validTime) {
            return response(['can not create at the moment'], 400);
        }

        $expired_at = now()->addMinutes($quizInfo->expiry);

        $quiz = Quiz::create([
            'quiz_info_id' => $quizInfo->id,
            'expired_at' => $expired_at,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $all_questions = Question::inRandomOrder()
            ->whereRaw('LENGTH(question) < 50')
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

        return $quiz;
    }

    public function notify($topic, $data)
    {
        $url = "https://fcm.googleapis.com/fcm/send";

        $client = new Client();

        try {
            $client->request("POST", $url, [
                'headers' => [
                    'Authorization' => env('FIREBASE_SERVER_KEY')
                ],
                'json' => [
                    'to' => $topic,
                    'notification' => $data,
                    'data' => $data,
                ]
            ]);

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
