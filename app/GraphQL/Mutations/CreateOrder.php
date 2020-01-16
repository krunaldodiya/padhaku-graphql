<?php

namespace App\GraphQL\Mutations;

use App\Order;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateOrder
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        $order = Order::create(['user_id' => $user->id, 'plan_id' => $args['plan_id']]);

        return Order::find($order->id);
    }
}
