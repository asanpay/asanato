<?php

namespace App\Containers\Bank\Enum;

use App\Ship\Traits\CustomEnums;

class BankAccountStatus
{

    use CustomEnums;

    const APPROVED = 'APPROVED';
    const PENDING  = 'PENDING';
    const REJECTED = 'REJECTED';

}
