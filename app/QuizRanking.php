<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuizRanking extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    protected $appends = [
        'score'
    ];

    public function getScoreAttribute()
    {
        $quiz_participants = DB::table('quiz_participants')
            ->where('user_id', auth()->id())
            ->where('quiz_id', $this->quiz_id)
            ->first();

        return $quiz_participants ? $quiz_participants->points : 0;
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
