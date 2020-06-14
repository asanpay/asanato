<?php

namespace App\Containers\Wallet\Enum;

use App\Ship\Traits\CustomEnums;

class WalletType
{

    use CustomEnums;

    const USER               = 'USER';     //wallet belongs to a user
    const GATEWAY            = 'GATEWAY';  //wallet belongs to a psp gateway that site works with
    const INCOMING_MONEY     = 'INCOMING_MONEY';   //wallet belongs to the incoming money
    const OUTGOING_MONEY     = 'OUTGOING_MONEY';   //wallet belongs to the outgoing money
    const PROFIT             = 'PROFIT';   //wallet belongs to the transactions profit
}
