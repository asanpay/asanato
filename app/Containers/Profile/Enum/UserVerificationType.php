<?php

namespace App\Containers\Profile\Enum;

use App\Ship\Traits\CustomEnums;

class UserVerificationType
{

    use CustomEnums;

    const MOBILE    = 1;
    const EMAIL     = 2;
    const TEL       = 4;
    const RESIDENCY = 8;
    const IDENTITY  = 16;
    const COMPANY   = 32;

    function translations()
    {
        return [
            self::EMAIL       => trans('verification.type.' . self::EMAIL),
            self::MOBILE      => trans('verification.type.' . self::MOBILE),
            self::TEL         => trans('verification.type.' . self::TEL),
            self::RESIDENCY   => trans('verification.type.' . self::RESIDENCY),
            self::IDENTITY    => trans('verification.type.' . self::IDENTITY),
            self::COMPANY     => trans('verification.type.' . self::COMPANY),
        ];
    }
}
