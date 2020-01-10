<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetQuizAnswers
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return DB::table('quiz_answers')
            ->where([
                'quiz_id' => $args['quiz_id'],
                'user_id' => $user->id
            ])
            ->get();
    }
}
