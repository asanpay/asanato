<?php

namespace App\Containers\IdentityProof\Enum;

use App\Ship\Traits\CustomEnums;

class IdPoofType
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
            self::EMAIL       => trans('auth.proof.type.' . self::EMAIL),
            self::MOBILE      => trans('auth.proof.type.' . self::MOBILE),
            self::TEL         => trans('auth.proof.type.' . self::TEL),
            self::RESIDENCY   => trans('auth.proof.type.' . self::RESIDENCY),
            self::IDENTITY    => trans('auth.proof.type.' . self::IDENTITY),
            self::COMPANY     => trans('auth.proof.type.' . self::COMPANY),
        ];
    }
}
