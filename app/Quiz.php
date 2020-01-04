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
        'all_questions_meta' => 'json',
        'answerable_questions_meta' => 'json',
    ];
}
