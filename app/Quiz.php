<?php

namespace App;

use App\Traits\HasUuid;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Quiz extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    protected $appends = [
        'quiz_status', 'quiz_prize'
    ];

    public function getQuizStatusAttribute()
    {
        $quiz_participant = DB::table('quiz_participants')
            ->where('quiz_id', $this->id)
            ->where('user_id', auth()->id())
            ->first();

        return $quiz_participant ? $quiz_participant->quiz_status : "pending";
    }

    public function getQuizPrizeAttribute()
    {
        return collect($this->quiz_infos->distribution)->sum('price');
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

    public function scopeOrderAndFilter($query, $args)
    {
        return $query->orderBy("expired_at", "DESC");
    }

    public function myQuizzes($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = auth()->user();

        return Quiz::with('quiz_infos', 'participants', 'questions')
            ->whereHas('participants', function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            });
    }
}
