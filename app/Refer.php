<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Refer extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function refer_source()
    {
        return $this->belongsTo(ReferSource::class);
    }
}
