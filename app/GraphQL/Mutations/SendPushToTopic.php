<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use GuzzleHttp\Client;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SendPushToTopic
{
    public function handle($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $url = "https://fcm.googleapis.com/fcm/send";

        $client = new Client();

        try {
            $client->request("POST", $url, [
                'headers' => [
                    'Authorization' => env('FIREBASE_AUTH_KEY')
                ],
                'json' => [
                    'to' => $args['topic'],
                    'notification' => $args['data'],
                    'data' => $args['data'],
                ]
            ]);

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
