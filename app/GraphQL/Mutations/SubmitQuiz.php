<?php

namespace App\GraphQL\Mutations;

use App\Quiz;
use Error;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SubmitQuiz
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $quiz = Quiz::find($args['quiz_id']);

        $quiz_participant = DB::table("quiz_participants")
            ->where(['user_id' => $user->id, 'quiz_id' => $quiz->id])
            ->first();

        if ($quiz_participant->quiz_status !== 'started') {
            throw new Error("Can not submit quiz");
        }

        $answers = collect($args['meta'])
            ->map(function ($answer) use ($user, $quiz) {
                $points = $answer['answer'] == $answer['current_answer'] ? 10000 / $answer['seconds'] : 0;

                return [
                    'user_id' => $user->id,
                    'quiz_id' => $quiz->id,
                    'question_id' => $answer['question_id'],
                    'points' => $points,
                    'time' => $answer['seconds'],
                    'current_answer' => $answer['current_answer'],
                    'answer' => $answer['answer'],
                ];
            })
            ->toArray();

        DB::table("quiz_answers")->insert($answers);

        $total_points = collect($answers)->sum('points');

        DB::table("quiz_participants")
            ->where([
                'quiz_id' => $answers[0]['quiz_id'],
                'user_id' => $user->id,
            ])
            ->update([
                'points' => $total_points,
                'quiz_status' => 'finished',
            ]);

        return true;
    }
}
