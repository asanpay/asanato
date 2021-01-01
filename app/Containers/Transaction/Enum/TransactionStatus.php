<?php

namespace App\Containers\Transaction\Enum;

use App\Ship\Traits\CustomEnums;

class TransactionStatus
{
    use CustomEnums;

    const NEW          = '1';
    const GONE_TO_GATE = '2';
    const CALLBACK     = '4';
    const VERIFIED     = '8';
    const SETTLED      = '16';
    const ACCOMPLISHED = '32';
    const REFUNDED     = '64';

    public function translations()
    {
        return [
            self::NEW          => 'جدید',
            self::GONE_TO_GATE => 'رفته به درگاه',
            self::CALLBACK     => 'بازگشت از درگاه',
            self::VERIFIED     => 'تایید شده',
            self::SETTLED      => 'تسویه شده',
            self::ACCOMPLISHED => 'تکمیل شده',
            self::REFUNDED     => 'بازگشت داده شده',
        ];
    }
}
