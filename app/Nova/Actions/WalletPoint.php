<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;

class WalletPoint extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $points = $fields->points;
        $description = $fields->description;
        $type = $fields->type;

        if (!$type) {
            return Action::message("Select a type");
        }

        foreach ($models as $user) {
            $transaction = $user->createTransaction($points, $type, [
                'points' => [
                    'id' => $user->id,
                    'type' => $description
                ]
            ]);

            $user->deposit($transaction->transaction_id);
        }

        return Action::message("Wallet has been updated");
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make("Type")
                ->options([
                    'deposit' => 'Deposit',
                    'withdraw' => 'Withdraw',
                ]),
            Text::make('Points'),
            Text::make('Description'),
        ];
    }
}
