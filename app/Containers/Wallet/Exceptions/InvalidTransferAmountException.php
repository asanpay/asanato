<?php

namespace App\Containers\Wallet\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidTransferAmountException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

    public $message = 'Transfer amount should be a value greater than zero';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::INVALID_TRANSFER_AMOUNT;
    }
}
