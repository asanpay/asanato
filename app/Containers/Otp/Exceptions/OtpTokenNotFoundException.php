<?php


namespace App\Containers\Otp\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class OtpTokenNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_EXPECTATION_FAILED;

    public $message = 'Otp token not found!';

    public $code = 100001;

    public function addCustomData() {
        return [
            'message' => __('auth.otp_not_found'),
        ];
    }

    public function useErrorCode()
    {
        return CustomErrorCodesTable::OTP_TOKEN_NOT_FOUND;
    }
}
