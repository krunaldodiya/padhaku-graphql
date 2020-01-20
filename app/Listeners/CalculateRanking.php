<?php

namespace App\Listeners;

use App\Events\QuizFinished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CalculateRanking
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
     * @param  QuizFinished  $event
     * @return void
     */
    public function handle(QuizFinished $event)
    {
        $quiz = $event->quiz;
    }
}
