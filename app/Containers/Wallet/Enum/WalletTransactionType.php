<?php

namespace App\Containers\Wallet\Enum;

use App\Ship\Traits\CustomEnums;

class WalletTransactionType
{
    use CustomEnums;

    const DEPOSIT     = 1;
    const TRANSFER    = 2;
    const TOP_UP      = 3;
    const WITHDRAW    = 4;
    const MERCHANT    = 5;
    const SMS_COST    = 6;
    const REFUND      = 7;
    const WALLET_COST = 8;
}
