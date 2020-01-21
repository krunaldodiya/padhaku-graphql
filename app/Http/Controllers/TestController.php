<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::get();

        return $categories;
    }

    public function filterPeriod($period)
    {
        switch ($period) {
            case 'Today':
                now()->startOfDay();
                break;

            case 'This Week':
                now()->startOfWeek();
                break;

            case 'This Month':
                now()->startOfMonth();
                break;

            default:
                return 'All';
                break;
        }
    }

    public function test(Request $request)
    {
        $period = $this->filterPeriod($request->period);

        $users = User::with('country', 'quiz_rankings')->get();

        return $users
            ->map(function ($user) use ($period) {
                $quiz_rankings = $user->quiz_rankings()->where(function ($query) use ($period) {
                    if ($period !== 'All') {
                        return $query->where('created_at', '>=', $period);
                    }
                });

                return [
                    'user' => $user->toArray(),
                    'earnings' => $quiz_rankings->sum('prize_amount')
                ];
            })
            ->sortByDesc('earnings')
            ->toArray();
    }
}
