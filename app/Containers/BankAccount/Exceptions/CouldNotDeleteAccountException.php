<?php

namespace App\Containers\BankAccount\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class CouldNotDeleteAccountException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Could not delete approved accounts';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::ACCOUNT_DELETE_FAILED;
    }
}
