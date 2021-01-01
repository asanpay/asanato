<?php

namespace App\Containers\Helpdesk\Enum;

use App\Ship\Traits\CustomEnums;

class TicketPriority
{
    use CustomEnums;

    const LOW    = '1';
    const MEDIUM = '2';
    const HIGH   = '4';


    public function translations()
    {
        return [
            self::LOW    => 'کم',
            self::MEDIUM => 'متوسط',
            self::HIGH   => 'بالا',
        ];
    }
}
