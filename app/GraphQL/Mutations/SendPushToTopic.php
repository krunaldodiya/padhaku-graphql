<?php

namespace App\GraphQL\Mutations;

use App\Repositories\Contracts\QuizRepositoryInterface;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SendPushToTopic
{
    public $quizRepository;

    public function __construct(QuizRepositoryInterface $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function handle($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->quizRepository->notify($args['topic'], $args['data']);
    }
}
