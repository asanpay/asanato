<?php

namespace App\Containers\Transaction\Enum;

use App\Ship\Traits\CustomEnums;

/**
 * - Merchant --- when merchant_id is not null
 *
 * Class TransactionType
 *
 * @package App\Containers\Transaction\Enum
 */
class TransactionType
{
    use CustomEnums;

    const MERCHANT     = 1; // تراکنش درگاه
    const WALLET_TOPUP = 2; // تراکنش شارژ
    const DEPOSIT = 3; // تراکنش واریز به حساب از درگاه شخصی
}
