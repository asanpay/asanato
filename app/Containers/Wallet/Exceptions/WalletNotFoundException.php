<?php

namespace App\Containers\Wallet\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class WalletNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = 'wallet not found';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::WALLET_NOT_FOUND;
    }
}
