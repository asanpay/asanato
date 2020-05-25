<?php


namespace App\Containers\Otp\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidOtpException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Invalid OTP token';

    public function addCustomData() {
        return [
            'message' => __('auth.invalid_otp'),
        ];
    }

    public function useErrorCode()
    {
        return CustomErrorCodesTable::INVALID_OTP;
    }
}
