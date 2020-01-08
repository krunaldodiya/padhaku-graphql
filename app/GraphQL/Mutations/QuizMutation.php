<?php

namespace App\GraphQL\Mutations;

use Error;

use App\Quiz;
use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class QuizMutation
{
    public function joinQuiz($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $quiz_id = $args['quiz_id'];
        $user = auth()->user();

        $timezone = 'Asia/Kolkata';
        $now = Carbon::now($timezone);

        $quiz = Quiz::with('quiz_infos', 'participants')->where('id', $quiz_id)->first();

        // check if already joined
        if ($quiz->is_joined) {
            throw new Error("Already joined");
        }

        // check if registation is not closed
        $registration_on_till = Carbon::parse($quiz->expired_at, $timezone)->subMinutes($quiz->quiz_infos->reading);
        if ($now >= $registration_on_till) {
            throw new Error("Registration line is closed");
        }

        // check if vacancy is not full
        if ($quiz->participants->count() === $quiz->quiz_infos->total_participants) {
            throw new Error("Participants are full");
        }

        // check if user wallet has enough points
        if ($quiz->quiz_infos->entry_fee > $user->wallet->balance) {
            throw new Error("Not Enough wallet points");
        }

        $quiz->participants()->attach($user->id);

        $questions = $quiz
            ->questions
            ->filter(function ($question) {
                return $question->pivot->is_answerable;
            })
            ->map(function ($question) use ($quiz, $user) {
                return [
                    'quiz_id' => $quiz->id,
                    'question_id' => $question->id,
                    'user_id' => $user->id,
                ];
            })
            ->toArray();

        DB::table('quiz_answers')->insert($questions);

        $transaction = $user->createTransaction($quiz->quiz_infos->entry_fee, 'withdraw', [
            'points' => [
                'id' => $user->id,
                'type' => "Joined Quiz"
            ]
        ]);

        $user->deposit($transaction->transaction_id);

        return $quiz->fresh();
    }
}
