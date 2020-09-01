<?php

namespace App\Containers\Withdrawal\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class CouldNotChangeFinalizedWithdrawException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

    public $message = 'You can not modify a finalized withdrawal request';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::WITHDRAW_UNCHANGABLE;
    }
}
