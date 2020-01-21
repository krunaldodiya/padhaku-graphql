<?php

namespace App\Jobs;

use App\Quiz;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CalculateRanking implements ShouldQueue
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
    public function handle()
    {
        $quiz_data = Quiz::with('quiz_infos')->find($this->quiz->id);

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
                'prize_amount' => $contribution['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        DB::table("quiz_rankings")->insert($quiz_rankings->toArray());
    }
}
