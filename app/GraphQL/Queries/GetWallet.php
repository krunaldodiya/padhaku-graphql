<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use KD\Wallet\Models\Wallet;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetWallet
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return Wallet::with('transactions')
            ->where('user_id', $user->id)
            ->whereHas('transactions', function ($query) {
                return $query->where('status', 'success');
            })
            ->orderBy('wallet_transactions.created_at')
            ->first();
    }
}
