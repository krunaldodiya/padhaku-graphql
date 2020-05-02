<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'topic_subscribers');
    }
}
