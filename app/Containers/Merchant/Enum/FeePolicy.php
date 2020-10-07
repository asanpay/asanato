<?php
namespace App\Containers\Merchant\Enum;

use App\Ship\Traits\CustomEnums;

class FeePolicy
{
    use CustomEnums;

    const PERCENT = 'PERCENT';
    const PERMANENT = 'PERMANENT';
    const TURNOVER = 'TURNOVER';
}
