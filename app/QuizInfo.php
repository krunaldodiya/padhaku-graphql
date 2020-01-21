<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class QuizInfo extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    protected $casts = [
        'distribution' => 'json',
    ];
}
