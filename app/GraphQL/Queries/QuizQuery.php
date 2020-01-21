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
        $timezone = "Asia/Kolkata";
        $now = Carbon::now($timezone);

        return Quiz::with('quiz_infos', 'questions')->where('expired_at', '>=', $now)->get();
    }
}
