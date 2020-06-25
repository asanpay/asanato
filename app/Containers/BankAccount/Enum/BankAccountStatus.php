<?php

namespace App\Containers\BankAccount\Enum;

use App\Ship\Traits\CustomEnums;

class BankAccountStatus
{

    use CustomEnums;

    const PENDING  = 'PENDING';
    const APPROVED = 'APPROVED';
    const REJECTED = 'REJECTED';

}
