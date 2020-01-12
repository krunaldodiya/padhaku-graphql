<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class VerifyPaytmChecksum
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $checksum = $args['checksum'];
        $checksum_verify = $args['checksum_verify'];

        return verifychecksum_e($checksum, env('PAYTM_MERCHANT_KEY'), $checksum_verify);
    }
}
