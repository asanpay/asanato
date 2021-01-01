<?php


namespace App\Containers\User\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class UserNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = 'User not found!';

    public $code = 100000;

    public function addCustomData()
    {
        return [
            'message' => __('auth.user_not_found'),
        ];
    }

    public function useErrorCode()
    {
        return CustomErrorCodesTable::OTP_USER_NOT_FOUND;
    }
}
