<?php

namespace App\Listeners;

use App\Events\QuizGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\CalculateQuizRanking;
use App\Jobs\CheckQuizStatus;
use App\Jobs\SendQuizNotification;

class HandleQuizGenerated
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

        SendQuizNotification::dispatch($quiz)->delay($quiz->expired_at->subMinutes(15));
        CheckQuizStatus::dispatch($quiz)->delay($quiz->expired_at->subSeconds(5));
        CalculateQuizRanking::dispatch($quiz)->delay($quiz->expired_at->addMinutes(15));
    }
}
