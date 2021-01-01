<?php

namespace App\Containers\User\Enum;

use App\Ship\Traits\CustomEnums;

class UserGender
{
    use CustomEnums;

    const UNKNOWN = 'UNKNOWN';
    const MALE    = 'MALE';
    const FEMALE  = 'FEMALE';

    public function translations()
    {
        return [
            self::MALE    => __('user.gender.male'),
            self::FEMALE  => __('user.gender.female'),
            self::UNKNOWN => __('app.unknown'),
        ];
    }
}
