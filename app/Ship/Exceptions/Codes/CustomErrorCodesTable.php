<?php

namespace App\Ship\Exceptions\Codes;

use App\Ship\Parents\Exceptions\ErrorCodesTable;

/**
 * Class CustomErrorCodesTable
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class CustomErrorCodesTable extends ErrorCodesTable
{
    /**
     * Use this class to define your own custom error code tables. Please follow the scheme defined in the other file
     * in order to make them compliant!
     *
     * Please note that Apiato reserves the error codes 000000 - 099999 for itself. If you define your own codes,
     * please start with 100000
     *
     * const BASE_GENERAL_ERROR = [
     *      'code' => 100000,
     *      'title' => 'Unknown / Unspecified Error.',
     *      'description' => 'Something unexpected happened.',
     *  ];
     *
     */

    const OTP_USER_NOT_FOUND = [
        'code' => 100000,
    ];

    const OTP_TOKEN_NOT_FOUND = [
        'code' => 100001,
    ];

    const PAYER_WALLET_NOT_FOUND = [
        'code' => 100002
    ];

    const INSUFFICIENT_WALLET_BALANCE = [
        'code' => 100003
    ];

    const INVALID_TRANSFER_AMOUNT = [
        'code' => 100004
    ];

    const WALLET_TRANSFER_FAILED = [
        'code' => 100005
    ];

    const WALLET_DELETE_FAILED = [
        'code' => 100006
    ];

    const WALLET_NOT_FOUND = [
        'code' => 100008
    ];

    const WALLET_IS_LOCKED = [
        'code' => 100009
    ];

    const WALLET_OWNERSHIP_FAILED = [
        'code' => 100010
    ];

    const INVALID_OTP = [
        'code' => 100011
    ];
}
