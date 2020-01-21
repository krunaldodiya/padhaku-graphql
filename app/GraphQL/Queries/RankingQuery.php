<?php

namespace App\GraphQL\Queries;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class RankingQuery
{
    public function filterPeriod($period)
    {
        switch ($period) {
            case 'Today':
                return now()->startOfDay();

            case 'This Week':
                return now()->startOfWeek();

            case 'This Month':
                return now()->startOfMonth();

            default:
                return 'All';
        }
    }

    public function getRankings($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $period = $this->filterPeriod($args['period']);

        $users = User::with('country', 'quiz_rankings')->get();

        return $users
            ->map(function ($user) use ($period) {
                $quiz_rankings = $user->quiz_rankings()->where(function ($query) use ($period) {
                    if ($period !== 'All') {
                        return $query->where('created_at', '>=', $period);
                    }
                });

                return [
                    'user' => $user,
                    'earnings' => $quiz_rankings->sum('prize_amount')
                ];
            })
            ->sortByDesc('earnings')
            ->toArray();
    }
}
