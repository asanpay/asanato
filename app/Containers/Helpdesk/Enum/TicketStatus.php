<?php

namespace App\Containers\Helpdesk\Enum;

use App\Ship\Traits\CustomEnums;

class TicketStatus
{
    use CustomEnums;

    const NEW      = '1';
    const PENDING  = '2';
    const ANSWERED = '4';
    const RESOLVED = '8';
    const CLOSED   = '16';


    public function translations()
    {
        return [
            self::NEW      => 'جدید',
            self::PENDING  => 'منتظر پاسخ',
            self::ANSWERED => 'پاسخ داده شده',
            self::RESOLVED => 'حل شده',
            self::CLOSED   => 'بسته شده',
        ];
    }
}
