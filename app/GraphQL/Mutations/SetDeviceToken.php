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

        try {
            return DeviceToken::updateOrCreate($data, $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
