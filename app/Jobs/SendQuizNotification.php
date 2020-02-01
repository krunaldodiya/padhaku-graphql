<?php

namespace App\Jobs;

use App\Quiz;
use App\Repositories\Contracts\QuizRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendQuizNotification implements ShouldQueue
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
    public function handle(QuizRepositoryInterface $quizRepository)
    {
        $quizRepository->notify("quiz_reminder_{$this->quiz->id}", [
            'title' => 'Reminder', 'body' => 'Quiz will start in 15 minutes'
        ]);
    }
}
