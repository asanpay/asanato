<?php

namespace App\Containers\Transfer\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class WalletIsLockedException extends Exception
{
    public $httpStatusCode = Response:: HTTP_UNPROCESSABLE_ENTITY;

    public $message = 'Wallet is locked';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::WALLET_IS_LOCKED;
    }
}
