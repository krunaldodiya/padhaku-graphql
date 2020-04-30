<?php

namespace App\GraphQL\Queries;

use App\QuizRanking;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetQuizWinners
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return QuizRanking::with('quiz', 'user')
            ->where('quiz_id', $args['quiz_id'])
            ->orderBy('rank', 'asc')
            ->get();
    }
}
