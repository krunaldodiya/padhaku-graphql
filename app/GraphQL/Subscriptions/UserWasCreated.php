<?php

namespace App\GraphQL\Subscriptions;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Http\Request;
use Nuwave\Lighthouse\Schema\Types\GraphQLSubscription;
use Nuwave\Lighthouse\Subscriptions\Subscriber;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserWasCreated extends GraphQLSubscription
{
    public function authorize(Subscriber $subscriber, Request $request): bool
    {
        return true;
    }

    public function filter(Subscriber $subscriber, $root): bool
    {
        return true;
    }

    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): User
    {
        return $root;
    }
}
