<?php

namespace App\Observers;

use App\TopicSubscriber;

class TopicSubscriberObserver
{
    /**
     * Handle the topic subscriber "created" event.
     *
     * @param  \App\TopicSubscriber  $topicSubscriber
     * @return void
     */
    public function created(TopicSubscriber $topicSubscriber)
    {
        dump($topicSubscriber);
    }

    /**
     * Handle the topic subscriber "updated" event.
     *
     * @param  \App\TopicSubscriber  $topicSubscriber
     * @return void
     */
    public function updated(TopicSubscriber $topicSubscriber)
    {
        //
    }

    /**
     * Handle the topic subscriber "deleted" event.
     *
     * @param  \App\TopicSubscriber  $topicSubscriber
     * @return void
     */
    public function deleted(TopicSubscriber $topicSubscriber)
    {
        //
    }

    /**
     * Handle the topic subscriber "restored" event.
     *
     * @param  \App\TopicSubscriber  $topicSubscriber
     * @return void
     */
    public function restored(TopicSubscriber $topicSubscriber)
    {
        //
    }

    /**
     * Handle the topic subscriber "force deleted" event.
     *
     * @param  \App\TopicSubscriber  $topicSubscriber
     * @return void
     */
    public function forceDeleted(TopicSubscriber $topicSubscriber)
    {
        //
    }
}
