<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SubmitQuiz
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $answers = collect($args['meta'])->map(function ($answer) use ($user) {
            $points = $answer['answer'] == $answer['current_answer'] ? 10 / ($answer['seconds'] + 1) : 0;

            return [
                'user_id' => $user->id,
                'quiz_id' => $answer['quiz_id'],
                'question_id' => $answer['question_id'],
                'points' => $points,
                'time' => $answer['seconds'],
                'answer' => $answer['answer'],
                'attempted' => !!$answer['answer'],
            ];
        });

        dump($answers);

        return true;
    }
}
