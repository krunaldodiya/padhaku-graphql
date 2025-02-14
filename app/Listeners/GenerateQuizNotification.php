<?php

namespace App\Listeners;

use App\Events\QuizGenerated;
use App\Jobs\CheckQuizStatus;
use App\Jobs\SendQuizNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateQuizNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuizGenerated  $event
     * @return void
     */
    public function handle(QuizGenerated $event)
    {
        $quiz = $event->quiz;

        SendQuizNotification::dispatch($quiz)->delay($quiz->expired_at->subMinutes($quiz->quiz_infos->notify));

        CheckQuizStatus::dispatch($quiz)->delay($quiz->expired_at);
    }
}
