<?php

namespace App\Jobs;

use App\Quiz;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CheckQuizStatus implements ShouldQueue
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

        $minimum_participants = $quiz_data->participants()->count() >= $quiz_data->quiz_infos->total_participants;
        $minimum_winners = $quiz_data->participants()->where('quiz_status', 'started')->count() >= $quiz_data->quiz_infos->total_winners;

        if (!$minimum_participants || !$minimum_winners) {
            return $quizRepo->cancelQuiz($quiz_data);
        }
    }
}
