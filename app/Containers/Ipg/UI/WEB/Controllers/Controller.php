<?php

namespace App\Containers\Ipg\UI\WEB\Controllers;

use App\Containers\Ipg\UI\WEB\Requests\IpgGatewayPageRequest;
use App\Containers\Ipg\UI\WEB\Requests\IpgRequestTokenRequest;
use App\Containers\Ipg\UI\WEB\Requests\IpgTransactionCallbackRequest;
use App\Containers\Ipg\UI\WEB\Requests\IpgVerifyTransactionRequest;
use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Ipg\UI\WEB\Controllers
 */
class Controller extends WebController
{
    /**
     * @param string $token
     * @param IpgGatewayPageRequest $request
     *
     * @return mixed
     */
    public function gatewayPage(string $token, IpgGatewayPageRequest $request)
    {
        return Apiato::call('Ipg@GatewayPageAction', [$token, $request]);
    }

    /**
     * @param string $psp
     * @param string $gateway
     * @param string $token
     * @param IpgTransactionCallbackRequest $request
     *
     * @return
     */
    public function transactionCallback(string $psp, string $gateway, string $token, IpgTransactionCallbackRequest $request)
    {
        return Apiato::call('Ipg@TransactionCallbackAction', [$psp, $gateway, $token, $request]);
    }
}
