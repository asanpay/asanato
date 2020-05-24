<?php


namespace App\Containers\Otp\Enum;


use App\Ship\Traits\CustomEnums;

class OtpBroker
{
    use CustomEnums;

    const MOBILE = 'mobile';
    const EMAIL  = 'email';
    const GOOGLE_AUTH  = 'google_auth';
}
