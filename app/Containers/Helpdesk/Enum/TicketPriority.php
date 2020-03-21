<?php


namespace App\Enum;


use App\Traits\CustomEnums;

class TicketPriority
{
    use CustomEnums;

    const LOW    = '1';
    const MEDIUM = '2';
    const HIGH   = '4';


    function translations()
    {
        return [
            self::LOW    => 'کم',
            self::MEDIUM => 'متوسط',
            self::HIGH   => 'بالا',
        ];
    }
}
