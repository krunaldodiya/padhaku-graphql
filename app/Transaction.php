<?php

namespace App;

use App\Traits\HasUuid;
use KD\Wallet\Models\Transaction as KDWalletTransaction;

class Transaction extends KDWalletTransaction
{
    use HasUuid;

    public $incrementing = false;

    protected $guarded = [];

    public $timestamps = false;

    protected $appends = [
        'day'
    ];

    public function getDayAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }
}
