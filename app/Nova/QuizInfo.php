<?php

namespace App\Nova;

use App\Nova\Actions\GenerateQuiz;
use App\Repositories\QuizRepository;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use R64\NovaFields\Number;
use R64\NovaFields\Row;

class QuizInfo extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\QuizInfo';

    public static $group = 'Quiz';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Boolean::make("Auto"),
            Text::make('Entry Fee (Coins)', 'entry_fee')->sortable(),
            Text::make('total_participants')->sortable(),
            Text::make('total_winners')->sortable(),
            Text::make('all_questions_count')->sortable(),
            Text::make('answerable_questions_count')->sortable(),
            Text::make('Expiry (minutes)', 'expiry')->sortable(),
            Text::make('Notify Before (Minutes)', 'reading')->sortable(),
            Text::make('Time Per Question (Seconds)', 'time')->sortable(),
            Row::make('Price Distribution', [
                Number::make('Rank'),
                Number::make('Coins', 'price'),
            ], 'distribution'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [new GenerateQuiz(new QuizRepository)];
    }
}
