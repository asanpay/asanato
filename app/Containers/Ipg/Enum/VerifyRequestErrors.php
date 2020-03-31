<?php

namespace App\Containers\Ipg\Enum;

use App\Ship\Traits\CustomEnums;

class VerifyRequestErrors
{
    use CustomEnums;

    const OK = 0;
    const MERCHANT_NOT_FOUND = -1;
    const DISABLED_MERCHANT = -2;
    const INVALID_TOKEN = -3;
    const NOT_ACCOMPLISH_READY = -4;
    const TRANSACTION_NOT_FOUND = -5;
    const UNKNOWN_ERROR = -999;
}
