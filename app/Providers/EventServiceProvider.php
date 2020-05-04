<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\UserCreated;
use App\Events\QuizGenerated;
use App\Events\TopicSubscribed;

use App\Listeners\GenerateUsername;
use App\Listeners\AddBonusPoint;
use App\Listeners\CheckInvitation;

use App\Listeners\GenerateQuizTopic;
use App\Listeners\GenerateQuizNotification;
use App\Listeners\HandleQuizGenerated;
use App\Listeners\CreateTopicListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        UserCreated::class => [
            AddBonusPoint::class,
            CheckInvitation::class,
        ],

        QuizGenerated::class => [
            GenerateQuizTopic::class,
            GenerateQuizNotification::class,
            HandleQuizGenerated::class,
        ],

        TopicSubscribed::class => [
            CreateTopicListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
