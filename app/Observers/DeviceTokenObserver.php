<?php

namespace App\Observers;

use App\DeviceToken;

class DeviceTokenObserver
{
    public function manageTokens(DeviceToken $deviceToken)
    {
        dump($deviceToken);
    }

    /**
     * Handle the device token "created" event.
     *
     * @param  \App\DeviceToken  $deviceToken
     * @return void
     */
    public function created(DeviceToken $deviceToken)
    {
        $this->manageTokens($deviceToken);
    }

    /**
     * Handle the device token "updated" event.
     *
     * @param  \App\DeviceToken  $deviceToken
     * @return void
     */
    public function updated(DeviceToken $deviceToken)
    {
        $this->manageTokens($deviceToken);
    }

    /**
     * Handle the device token "deleted" event.
     *
     * @param  \App\DeviceToken  $deviceToken
     * @return void
     */
    public function deleted(DeviceToken $deviceToken)
    {
        //
    }

    /**
     * Handle the device token "restored" event.
     *
     * @param  \App\DeviceToken  $deviceToken
     * @return void
     */
    public function restored(DeviceToken $deviceToken)
    {
        //
    }

    /**
     * Handle the device token "force deleted" event.
     *
     * @param  \App\DeviceToken  $deviceToken
     * @return void
     */
    public function forceDeleted(DeviceToken $deviceToken)
    {
        //
    }
}
