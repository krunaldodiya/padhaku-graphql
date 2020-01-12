<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GeneratePaytmChecksum
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $data = [
            'MID' => env('PAYTM_MERCHANT_ID'),
            'ORDERID' => $args['ORDER_ID'],
            'EMAIL' => $args['EMAIL'],
            'MOBILE_NO' => $args['MOBILE_NO'],
        ];

        return getChecksumFromString(json_encode($data), env('PAYTM_MERCHANT_KEY'));
    }
}
