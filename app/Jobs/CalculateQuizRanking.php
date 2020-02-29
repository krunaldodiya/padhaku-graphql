<?php

namespace App\Jobs;

use App\Quiz;
use App\Repositories\Contracts\QuizRepositoryInterface;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CalculateQuizRanking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $quiz;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(QuizRepositoryInterface $quizRepo)
    {
        $quiz_data = Quiz::with('participants', 'quiz_infos')->find($this->quiz->id);

        DB::table("quiz_participants")
            ->where('quiz_id', $quiz_data->id)
            ->where(function ($query) {
                return $query->where('quiz_status', 'joined')->orWhere('quiz_status', 'started');
            })
            ->update(['quiz_status' => 'missed']);

        $quiz_participants = DB::table('quiz_participants')
            ->where('quiz_id', $this->quiz->id)
            ->orderBy('points', 'desc')
            ->get();

        $quiz_rankings = $quiz_participants->map(function ($quiz_participant, $index) use ($quiz_data) {
            $rank = $index + 1;
            $contribution = collect($quiz_data->quiz_infos->distribution)->where('rank', $rank)->first();

            return [
                'quiz_id' => $quiz_participant->quiz_id,
                'user_id' => $quiz_participant->user_id,
                'rank' => $rank,
                'prize_amount' => $quiz_participant->quiz_status === 'finished' && $contribution ? $contribution['price'] : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        DB::table("quiz_rankings")->insert($quiz_rankings->toArray());

        $quiz_rankings->each(function ($quiz_ranking) {
            $user = User::find($quiz_ranking['user_id']);

            $transaction = $user->createTransaction($quiz_ranking['prize_amount'], 'deposit', [
                'points' => [
                    'id' => $user->id,
                    'type' => "Won Quiz"
                ]
            ]);

            $user->deposit($transaction->transaction_id);
        });

        Quiz::where('id', $quiz_data->id)->update(['status' => 'finished']);

        return $quizRepo->notify("/topics/quiz_reminder_{$quiz_data->id}", [
            'title' => 'Reminder',
            'body' => 'Quiz Winnners are now available',
            'image' => url('images/notify_winners.png'),
            'quiz_id' => $quiz_data->id
        ]);
    }
}
