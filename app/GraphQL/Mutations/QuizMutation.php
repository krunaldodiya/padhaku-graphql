<?php

namespace App\GraphQL\Mutations;

use Error;

use App\Quiz;
use App\Topic;
use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class QuizMutation
{
    public function joinQuiz($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $quiz_id = $args['quiz_id'];
        $user = auth()->user();

        $quiz = Quiz::with('quiz_infos', 'participants', 'questions')->where('id', $quiz_id)->first();

        if ($quiz->status !== 'pending') {
            throw new Error("Quiz has expired");
        }

        // check if already joined
        if ($quiz->is_joined) {
            throw new Error("Already joined");
        }

        // check if registation is not closed
        $registration_on_till = Carbon::parse($quiz->expired_at);
        if (now() >= $registration_on_till) {
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

        $topic = Topic::where('name', "quiz_reminder_{$quiz->id}")->first();
        $topic->subscribers()->attach($user);

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
