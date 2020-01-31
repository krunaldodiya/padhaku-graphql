<?php

namespace App;

use KD\Wallet\Models\Transaction as KDWalletTransaction;

class Transaction extends KDWalletTransaction
{
    protected $appends = [
        'day'
    ];

    public function getDayAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }
}
