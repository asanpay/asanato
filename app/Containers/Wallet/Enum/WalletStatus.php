<?php

namespace App\Containers\Wallet\Enum;

use App\Ship\Traits\CustomEnums;

class WalletStatus
{

    use CustomEnums;

    const ACTIVE  = 'ACTIVE';
    const LOCKED  = 'LOCKED';

}
