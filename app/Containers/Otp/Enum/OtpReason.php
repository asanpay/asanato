<?php


namespace App\Containers\Otp\Enum;


use App\Ship\Traits\CustomEnums;

class OtpReason
{
    use CustomEnums;

    const SIGN_UP        = 'signup';
    const TRANSFER_MONEY = 'transfer-money';
    const MOBILE_VERIFY  = 'mobile-verify';
    const EMAIL_VERIFY   = 'email-verify';
    const RESET_PASS     = 'reset-pass';
}
