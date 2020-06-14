<?php

namespace App\Containers\Transaction\Enum;

use App\Ship\Traits\CustomEnums;

class TransactionType
{
    use CustomEnums;

    const MERCHANT     = 1;
    const WALLET_TOPUP = 2;
}
