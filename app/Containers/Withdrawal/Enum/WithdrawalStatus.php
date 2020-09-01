<?php

namespace App\Containers\Withdrawal\Enum;

use App\Ship\Traits\CustomEnums;

class WithdrawalStatus
{

    use CustomEnums;

    const PENDING    = 0;
    const PROCESSING = 1;
    const DONE       = 2;
    const REJECTED   = 3;
    const CANCELED   = 4;

}
