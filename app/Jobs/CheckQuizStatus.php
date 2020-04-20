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

        $quiz_joined_participants = $quiz_data->participants()->count();

        if ($quiz_joined_participants < $quiz_data->quiz_infos->total_participants) {
            $quizRepo->cancelQuiz($quiz_data);

            return $quizRepo->notify("/topics/quiz_reminder_{$quiz_data->id}", [
                'title' => 'Quiz suspended!',
                'body' => 'Dont worry, more quizzes loaded for you!',
                'image' => url('images/notify_canceled.png'),
                'quiz_id' => $quiz_data->id,
            ]);
        }

        Quiz::where('id', $quiz_data->id)->update(['status' => 'started']);

        CalculateQuizRanking::dispatch($quiz_data)->delay($quiz_data->expired_at->addMinutes(5));

        return $quizRepo->notify("/topics/quiz_reminder_{$quiz_data->id}", [
            'title' => 'All the Best!',
            'body' => 'Hurry,Start the quiz NOW!',
            'image' => url('images/notify_started.jpg'),
            'quiz_id' => $quiz_data->id,
        ]);
    }
}
