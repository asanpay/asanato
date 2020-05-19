<?php

namespace App\Containers\Wallet\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class CouldNotDeleteWalletWithBalanceException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Could not delete wallet with remain balance please empty wallet first';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::WALLET_DELETE_FAILED;
    }
}
