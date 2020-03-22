<?php
namespace App\Containers\Wallet\Enum;

use App\Ship\Traits\CustomEnums;

class WageBy
{
    use CustomEnums;

    const MERCHANT = 'MERCHANT';
    const CUSTOMER = 'CUSTOMER';
}
