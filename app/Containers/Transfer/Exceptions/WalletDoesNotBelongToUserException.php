<?php

namespace App\Containers\Transfer\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class WalletDoesNotBelongToUserException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = 'The wallet does not belong to the user';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::WALLET_OWNERSHIP_FAILED;
    }
}
