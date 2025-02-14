<?php

namespace App\GraphQL\Queries;

use App\User;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetUserById
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return User::with('country', 'quiz_rankings')
            ->where('id', $args['user_id'])
            ->first();
    }
}
