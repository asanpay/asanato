<?php

namespace App\Containers\Helpdesk\Enum;

use App\Ship\Traits\CustomEnums;

class Platform
{
    use CustomEnums;

    const WEB     = 'WEB';
    const IOS     = 'IOS';
    const ANDROID = 'ANDROID';


    public function translations()
    {
        return [
            self::WEB     => 'WEB',
            self::IOS     => 'IOS',
            self::ANDROID => 'ANDROID',
        ];
    }
}
