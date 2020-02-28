<?php

namespace App\GraphQL\Mutations;

use Error;

use App\Quiz;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class StartQuiz
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();
        $quiz = Quiz::find($args['quiz_id']);

        $quiz_participant = DB::table("quiz_participants")
            ->where(['user_id' => $user->id, 'quiz_id' => $quiz->id])
            ->first();

        if (!$quiz_participant) {
            throw new Error("Quiz has not joined yet");
        }

        if ($quiz_participant->quiz_status !== 'joined') {
            throw new Error("Can't start quiz because it is already {$quiz_participant->quiz_status}");
        }

        if (now() >= $quiz->expired_at->addMinutes(15)) {
            throw new Error("Quiz has expired");
        }

        if (now() <= $quiz->expired_at) {
            throw new Error("Quiz has not started yet");
        }

        DB::table("quiz_participants")
            ->where(['user_id' => $user->id, 'quiz_id' => $quiz->id])
            ->update(['quiz_status' => 'started']);

        return true;
    }
}
