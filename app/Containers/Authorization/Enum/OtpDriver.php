<?php


namespace App\Containers\Authorization\Enum;


use App\Ship\Traits\CustomEnums;

class OtpDriver
{
    use CustomEnums;

    const SMS   = 'SMS';
    const EMAIL = 'EMAIL';
}
