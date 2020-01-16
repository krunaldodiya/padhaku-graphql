<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GeneratePaytmChecksum
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $checksum = $args['checksum'];

        return getChecksumFromArray($checksum, env('PAYTM_MERCHANT_KEY'));
    }
}
