<?php

namespace App\GraphQL\Mutations;

use App\Redeem;
use Error;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class WithdrawMoney
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $cash = $user->wallet->balance / 2;

        $exists = Redeem::where(['user_id' => $user->id, 'status' => 'pending'])->first();

        if ($exists) {
            throw new Error("You already have a pending request.");
        }

        if ($args['amount'] < 20) {
            throw new Error("You can't withdraw less than Rs. 20");
        }

        if ($cash < $args['amount']) {
            throw new Error("Not Enough Balance");
        }

        return Redeem::create([
            'user_id' => $user->id,
            'gateway' => $args['gateway'],
            'mobile' => $args['mobile'],
            'amount' => $args['amount']
        ]);
    }
}
