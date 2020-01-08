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

    protected $appends = [
        'is_joined',
    ];

    public function getIsJoinedAttribute()
    {
        $count = auth()->user()
            ->quizzes
            ->where('id', $this->id)
            ->count();

        return !!$count;
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'quiz_questions')->withPivot('is_answerable');
    }

    public function quiz_infos()
    {
        return $this->belongsTo(QuizInfo::class, 'quiz_info_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'quiz_participants');
    }
}
