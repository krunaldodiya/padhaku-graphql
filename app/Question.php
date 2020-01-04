<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    protected $appends = ['answer_hindi'];

    public function getAnswerHindiAttribute()
    {
        return "{$this->answer}_hindi";
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
