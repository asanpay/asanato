<?php
namespace App\Ship\Enum;

use App\Ship\Traits\CustomEnums;

class ApiCodes
{
    use CustomEnums;

    const CODE_OK = 200;
    const CODE_CREATED = 201;
    const CODE_ACCEPTED = 202;
    const CODE_NO_CONTENT = 204;
    const CODE_WRONG_ARGS = 422;
    const CODE_UNAUTHORIZED = 401;
    const CODE_NOT_FOUND = 404;
    const CODE_DUPLICATE = 409;
    const CODE_FORBIDDEN = 410;
    const TOO_MANY_REQUESTS = 429;
    const CODE_INTERNAL_ERROR = 500;
    const CODE_UNKNOWN_ERROR = 999;

    const NOT_ENOUGH_WALLET_BALANCE = 1000;

    const DEST_WALLET_IS_NOT_YOURS = 1001;

    const WALLET_TRANSFER_LIMIT_EXCEEDED = 1002;
}
