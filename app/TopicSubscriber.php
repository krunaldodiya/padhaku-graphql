<?php

namespace App;

use App\Events\TopicSubscribed;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TopicSubscriber extends Pivot
{
    protected $table = "topic_subscribers";
}
