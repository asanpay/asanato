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
            self::EMAIL       => trans('proof.type.' . self::EMAIL),
            self::MOBILE      => trans('proof.type.' . self::MOBILE),
            self::TEL         => trans('proof.type.' . self::TEL),
            self::RESIDENCY   => trans('proof.type.' . self::RESIDENCY),
            self::IDENTITY    => trans('proof.type.' . self::IDENTITY),
            self::COMPANY     => trans('proof.type.' . self::COMPANY),
        ];
    }
}
