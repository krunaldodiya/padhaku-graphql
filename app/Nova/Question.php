<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Question extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Question';

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
        'id', 'question'
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

            BelongsTo::make('Category'),

            Textarea::make('question')->showOnIndex()->alwaysShow(),
            Text::make('option_1')->hideFromIndex(),
            Text::make('option_2')->hideFromIndex(),
            Text::make('option_3')->hideFromIndex(),
            Text::make('option_4')->hideFromIndex(),

            Textarea::make('question_hindi')->hideFromIndex()->alwaysShow(),
            Text::make('option_1_hindi')->hideFromIndex(),
            Text::make('option_2_hindi')->hideFromIndex(),
            Text::make('option_3_hindi')->hideFromIndex(),
            Text::make('option_4_hindi')->hideFromIndex(),

            Text::make('answer')->hideFromIndex(),
            Avatar::make('Image')->hideFromIndex(),

            Date::make('Created At')
                ->hideFromIndex()
                ->sortable(),

            Date::make('Updated At')
                ->hideFromIndex()
                ->sortable(),
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
        return [];
    }
}
