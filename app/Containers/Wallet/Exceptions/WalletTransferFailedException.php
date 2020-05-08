<?php

namespace App\Containers\Wallet\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class WalletTransferFailedException extends Exception
{
    public $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Wallet to wallet transfer failed';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::WALLET_TRANSFER_FAILED;
    }
}
