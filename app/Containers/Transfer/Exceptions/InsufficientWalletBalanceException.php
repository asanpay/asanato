<?php

namespace App\Containers\Transfer\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class InsufficientWalletBalanceException extends Exception
{
    public $httpStatusCode = Response::HTTP_PAYMENT_REQUIRED;

    public $message = 'The wallet balance is not enough';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::INSUFFICIENT_WALLET_BALANCE;
    }
}
