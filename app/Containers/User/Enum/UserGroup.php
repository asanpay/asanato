<?php
namespace App\Containers\User\Enum;

use App\Ship\Traits\CustomEnums;

class UserGroup
{
    use CustomEnums;

    const NORMAL = 'NORMAL';
    const BRONZE = 'BRONZE';
    const SILVER = 'SILVER';
    const GOLD = 'GOLD';
    const PLATINUM = 'PLATINUM';
}
