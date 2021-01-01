<?php

namespace App\Containers\User\Enum;

use App\Ship\Traits\CustomEnums;

class UserType
{
    use CustomEnums;

    const UNKNOWN  = 'UNKNOWN';
    const PERSONAL = 'PERSONAL';
    const LEGAL    = 'LEGAL';

    public function translations()
    {
        return [
            self::PERSONAL => __('user.type.personal'),
            self::LEGAL    => __('user.type.legal'),
            self::UNKNOWN  => __('app.unknown'),
        ];
    }
}
