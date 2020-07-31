<?php

namespace App\Containers\Ipg\UI\API\Controllers;

use App\Containers\Ipg\UI\API\Requests\IpgRequestTokenRequest;
use App\Containers\Ipg\UI\API\Requests\IpgAccomplishTransactionRequest;
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

    /**
     * @param IpgAccomplishTransactionRequest $request
     *
     * @return mixed
     */
    public function accomplishTransaction(IpgAccomplishTransactionRequest $request)
    {
        return  Apiato::call('Ipg@AccomplishTransactionAction', [$request]);
    }
}
