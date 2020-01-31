<?php

namespace App\GraphQL\Mutations;

use App\DeviceToken;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SetDeviceToken
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        try {
            return DeviceToken::create(['user_id' => $user->id, 'token' => $args['device_token']]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
