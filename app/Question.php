<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
