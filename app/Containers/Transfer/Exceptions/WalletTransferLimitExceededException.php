<?php

namespace App\Containers\Transfer\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class WalletTransferLimitExceededException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

    public $message = 'Wallet transfer limit exceeded';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::INSUFFICIENT_WALLET_BALANCE;
    }
}
