<?php

namespace App;

use App\Traits\HasUuid;
use KD\Wallet\Models\Wallet as KDWallet;

class Wallet extends KDWallet
{
    use HasUuid;
}
