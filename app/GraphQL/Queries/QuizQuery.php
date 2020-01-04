<?php

namespace App\GraphQL\Queries;

use App\Quiz;
use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class QuizQuery
{
    public function getActiveQuizzes($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return Quiz::where('expired_at', '>=', Carbon::now())->get();
    }
}
