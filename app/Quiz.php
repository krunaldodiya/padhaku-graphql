<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    protected $casts = [
        'expired_at' => 'datetime',
        'answerable_questions_meta' => 'json',
        'all_questions_meta' => 'json'
    ];
}
