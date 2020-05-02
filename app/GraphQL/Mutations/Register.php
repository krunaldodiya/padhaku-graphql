<?php

namespace App\GraphQL\Mutations;

use App\Repositories\UserRepositoryInterface;
use App\Topic;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Tymon\JWTAuth\Facades\JWTAuth;

class Register
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::create([
            'mobile' => $args['mobile'],
            'country_id' => $args['country_id'],
            'name' => $args['name'],
            'username' => $args['username'],
            'email' => "{$args['username']}@pauzr.com",
            'password' => bcrypt($args['password']),
        ]);

        $public_topic = Topic::where(["name" => "user_all"])->first();
        $public_topic->subscribers()->attach($user);

        $private_topic = Topic::create(["name" => "user_{$user->id}"]);
        $private_topic->subscribers()->attach($user);

        if ($user) {
            $token = JWTAuth::fromUser($user);
            return $this->userRepository->createToken($user, $token);
        }
    }
}
