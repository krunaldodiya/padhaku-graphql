<?php

namespace App\GraphQL\Queries;

use App\Quiz;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetQuizById
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return Quiz::with('quiz_infos', 'participants', 'questions')->where('id', $args['quiz_id'])->first();
    }
}
