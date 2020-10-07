<?php

namespace App\Containers\Merchant\Enum;

use App\Ship\Traits\CustomEnums;

class FeeBy
{
    use CustomEnums;

    const MERCHANT = 'MERCHANT';
    const CUSTOMER = 'CUSTOMER';
    const NONE     = 'NONE';
}
