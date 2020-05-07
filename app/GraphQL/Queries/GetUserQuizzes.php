<?php

namespace App\GraphQL\Queries;

use App\Quiz;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetUserQuizzes
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return Quiz::with('quiz_infos', 'participants', 'questions')
            ->whereHas('participants', function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->get();
    }
}
