<?php

namespace App\Listeners;

use App\Events\QuizGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\CalculateRanking;

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

        CalculateRanking::dispatch($quiz)->delay($quiz->expired_at);
    }
}
