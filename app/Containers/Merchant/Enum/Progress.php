<?php

namespace App\Containers\Merchant\Enum;

use App\Ship\Traits\CustomEnums;

class Progress
{
    use CustomEnums;

    const CREATED = 0;
    const REJECTED = 1;
    const UNDER_REVIEW = 2;
    const APPROVED = 4;
}
