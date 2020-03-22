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
    const TRANSACTION_PROFIT = 'TRANSACTION_PROFIT';   //wallet belongs to the transactions profit
    const TRANSFER_PROFIT    = 'TRANSFER_PROFIT';   //wallet belongs to the money transfer profit
    const WITHDRAW_PROFIT    = 'WITHDRAW_PROFIT';   //wallet belongs to the withdraw profit
    const WALLET_COST_PROFIT = 'WALLET_COST_PROFIT';   //wallet belongs to the create wallet profit
}
