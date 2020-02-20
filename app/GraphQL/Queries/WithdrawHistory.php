<?php

namespace App\GraphQL\Queries;

use App\Redeem;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class WithdrawHistory
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return Redeem::where('user_id', $user->id)->get();
    }
}
