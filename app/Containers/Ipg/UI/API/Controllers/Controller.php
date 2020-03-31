<?php

namespace App\Containers\Ipg\UI\API\Controllers;

use App\Containers\Ipg\UI\API\Requests\IpgRequestTokenRequest;
use App\Containers\Ipg\UI\API\Requests\IpgVerifyTransactionRequest;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Ipg\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param IpgRequestTokenRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestPaymentToken(IpgRequestTokenRequest $request)
    {
        return  Apiato::call('Ipg@RequestPaymentTokenAction', [$request]);
    }

    public function verifyTransaction(IpgVerifyTransactionRequest $request)
    {
        return  Apiato::call('Ipg@VerifyTransactionAction', [$request]);
    }
}
