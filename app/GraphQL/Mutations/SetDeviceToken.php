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

        $data = ['user_id' => $user->id, 'token' => $args['device_token']];

        $exists = DeviceToken::where($data)->first();

        if (!$exists) {
            return DeviceToken::create($data);
        }
    }
}
