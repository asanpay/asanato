<?php

namespace App\Containers\Wallet\Models;

use App\Ship\Parents\Models\Model;

class MerchantWallet extends Model
{
    protected $table = 'merchant_wallet';

    public $timestamps = false;
}
