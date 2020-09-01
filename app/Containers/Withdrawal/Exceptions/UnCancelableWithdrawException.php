<?php

namespace App\Containers\Withdrawal\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class UnCancelableWithdrawException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

    public $message = 'The withdrawal ins not in the cancellation condition';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::WITHDRAW_UNCANCALABLE;
    }
}
