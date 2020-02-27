<?php

namespace App\Nova\Actions;

use App\Repositories\Contracts\QuizRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class GenerateQuiz extends Action
{
    use InteractsWithQueue, Queueable;

    public $onlyOnDetail = true;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $quiz_info = $models[0];

        // $this->quizRepo->generateQuiz(true, $quiz_info->id);

        return Action::message("Quiz has been generated. {$quiz_info->id}");
    }

    public function authorizedToSee(Request $request)
    {
        return in_array($request->user()->email, [
            "kunal.dodiya1@gmail.com",
            "aryanadya@gmail.com"
        ]);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
