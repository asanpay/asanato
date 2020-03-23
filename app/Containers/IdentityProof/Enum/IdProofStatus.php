<?php
namespace App\Containers\IdentityProof\Enum;

use App\Ship\Traits\CustomEnums;

class IdProofStatus
{
    use CustomEnums;

    const PENDING = 'PENDING';
    const REJECTED = 'REJECTED';
    const CANCELED = 'CANCELED';
    const CONFIRMED = 'CONFIRMED';
}
