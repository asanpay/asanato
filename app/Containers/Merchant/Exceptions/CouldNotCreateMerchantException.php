<?php

namespace App\Containers\Merchant\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class CouldNotCreateMerchantException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

    public $message = 'Could not process request parameters';

    public function useErrorCode()
    {
        return CustomErrorCodesTable::INVALID_MERCHANT_DATA;
    }
}
