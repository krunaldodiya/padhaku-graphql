<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
