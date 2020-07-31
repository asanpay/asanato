<?php

namespace App\Containers\Ipg\Enum;

use App\Ship\Traits\CustomEnums;

class RequestTokenErrors
{
    use CustomEnums;

    const OK                 = 0;
    const MERCHANT_NOT_FOUND = -1;
    const DISABLED_MERCHANT  = -2;

    const INVALID_AMOUNT           = -3;
    const INVALID_CALLBACK_URL     = -4;
    const INVALID_MOBILE           = -5;
    const INVALID_DESCRIPTION      = -6;
    const LOWER_AMOUNT_AFTER_FEE  = -7;
    const HIGHER_AMOUNT_AFTER_FEE = -8;
    const UNAUTHORIZED_IP_ADDRESS  = -9;
    const INVALID_EMAIL            = -10;
    const INVALID_NAME             = -11;
    const INVALID_INVOICE_ID       = -12;
    const INVALID_REFUND           = -13;
    const INVALID_DIRECT           = -14;
    const INVALID_PAYER_DATA       = -15;
    const INVALID_MULTIPLEX_DATA   = -16;

    const UNKNOWN_ERROR = -999;
}
