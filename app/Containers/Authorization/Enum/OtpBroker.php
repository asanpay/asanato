<?php


namespace App\Containers\Authorization\Enum;


use App\Ship\Traits\CustomEnums;

class OtpBroker
{
    use CustomEnums;

    const MOBILE = 'mobile';
    const EMAIL  = 'email';
}
