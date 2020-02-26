<?php

namespace App\GraphQL\Mutations;

use App\Repositories\Contracts\QuizRepositoryInterface;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GenerateQuiz
{
    public $quizRepository;

    public function __construct(QuizRepositoryInterface $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function handle($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        try {
            return $this->quizRepository->generateQuiz($args['force'], $args['quiz_info_id']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
