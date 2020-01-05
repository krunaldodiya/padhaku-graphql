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
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'quiz_questions')->withPivot('is_answerable');;
    }
}
