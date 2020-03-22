<?php

namespace App\Containers\Helpdesk\Enum;

use App\Ship\Traits\CustomEnums;

class TicketActionType
{
    use CustomEnums;

    const REPLY     = 'REPLY';
    const OPERATION = 'OPERATION';


    function translations()
    {
        return [
            self::REPLY     => 'پاسخ',
            self::OPERATION => 'عملیات',
        ];
    }
}
