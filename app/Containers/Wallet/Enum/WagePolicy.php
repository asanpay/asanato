<?php
namespace App\Containers\Wallet\Enum;

use App\Ship\Traits\CustomEnums;

class WagePolicy
{
    use CustomEnums;

    const PERCENT = 'PERCENT';
    const PERMANENT = 'PERMANENT';
    const TURNOVER = 'TURNOVER';
}
