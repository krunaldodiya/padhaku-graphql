<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
