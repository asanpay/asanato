<?php


namespace App\Containers\User\Exceptions;

use App\Ship\Exceptions\Codes\CustomErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class UserIsLockedException extends Exception
{
    public $httpStatusCode = Response::HTTP_LOCKED;

    public $message = 'User is locked!';

    public function addCustomData() {
        return [
            'message' => __('auth.user_is_locked'),
        ];
    }

    public function useErrorCode()
    {
        return CustomErrorCodesTable::USER_IS_LOCKED;
    }
}
