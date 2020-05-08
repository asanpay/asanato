<?php

namespace App\Containers\Wallet\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class PayerWalletNotDefinedException extends Exception
{
    public $httpStatusCode = Response::HTTP_PAYMENT_REQUIRED;

    public $message = 'The payer wallet is not defined';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::PAYER_WALLET_NOT_FOUND;
    }
}
