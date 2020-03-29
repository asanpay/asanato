<?php

namespace App\Containers\IdentityProof\Enum;

use App\Ship\Traits\CustomEnums;

class IdProofStatus
{
    use CustomEnums;

    const PENDING   = 'PENDING';
    const REJECTED  = 'REJECTED';
    const CANCELED  = 'CANCELED';
    const CONFIRMED = 'CONFIRMED';

    function translations()
    {
        return [
            self::PENDING   => trans('auth.proof.status.pending'),
            self::REJECTED  => trans('auth.proof.status.rejected'),
            self::CANCELED  => trans('auth.proof.status.canceled'),
            self::CONFIRMED => trans('auth.proof.status.confirmed'),
        ];
    }
}
