<?php

namespace App\Containers\Wallet\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class WalletIsLockedException extends Exception
{
    public $httpStatusCode = Response::HTTP_LOCKED;

    public $message = 'wallet is locked';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::WALLET_IS_LOCKED;
    }
}
