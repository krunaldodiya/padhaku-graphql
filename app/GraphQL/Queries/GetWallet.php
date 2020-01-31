<?php

namespace App\GraphQL\Queries;

use App\Transaction;
use App\Wallet;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetWallet
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $wallet = Wallet::where(['user_id' => $user->id])->first();

        $wallet['transactions'] = Transaction::query()
            ->where(['wallet_id' => $wallet->id, 'status' => 'success'])
            ->orderBy('created_at', 'desc')
            ->get();

        return $wallet;
    }
}
