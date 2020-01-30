<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use KD\Wallet\Models\Transaction;
use KD\Wallet\Models\Wallet;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetWallet
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $wallet = Wallet::where(['user_id' => $user->id])->first();

        $wallet['transactions'] = Transaction::query()
            ->where(['wallet_id' => $wallet->id, 'status' => 'success'])
            ->latest()
            ->get();

        return $wallet;
    }
}
