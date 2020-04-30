<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class ReferSource extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function refers()
    {
        return $this->hasMany(Refer::class);
    }
}
