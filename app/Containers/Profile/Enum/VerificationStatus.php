<?php
namespace App\Containers\Profile\Enum;

use App\Ship\Traits\CustomEnums;

class VerificationStatus
{
    use CustomEnums;

    const PENDING = 'PENDING';
    const REJECTED = 'REJECTED';
    const CANCELED = 'CANCELED';
    const CONFIRMED = 'CONFIRMED';
}
