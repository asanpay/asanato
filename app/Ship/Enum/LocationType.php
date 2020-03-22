<?php
namespace App\Ship\Enum;

use App\Ship\Traits\CustomEnums;

class LocationType
{
    use CustomEnums;

    const COUNTRY = 'COUNTRY';
    const STATE = 'STATE';
    const CITY = 'CITY';
}
