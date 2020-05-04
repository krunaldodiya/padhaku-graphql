<?php

namespace App\Providers;

use App\DeviceToken;
use App\Observers\DeviceTokenObserver;
use App\Observers\TopicSubscriberObserver;
use App\TopicSubscriber;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DeviceToken::observe(DeviceTokenObserver::class);
        TopicSubscriber::observe(TopicSubscriberObserver::class);
    }
}
