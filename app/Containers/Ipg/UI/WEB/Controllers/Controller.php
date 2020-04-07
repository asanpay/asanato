<?php

namespace App\Containers\Ipg\UI\WEB\Controllers;

use App\Containers\Ipg\UI\WEB\Requests\IpgTransactionCallbackRequest;
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
     * @param string $psp
     * @param string $gateway
     * @param string $token
     * @param IpgTransactionCallbackRequest $request
     */
    public function transactionCallback(string $psp, string $gateway, string $token, IpgTransactionCallbackRequest $request)
    {
        return Apiato::call('Ipg@TransactionCallbackAction', [$psp, $gateway, $token, $request]);
    }
}
