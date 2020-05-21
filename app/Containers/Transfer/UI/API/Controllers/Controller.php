<?php

namespace App\Containers\Transfer\UI\API\Controllers;

use App\Containers\Transfer\UI\API\Requests\TransferBetweenMyWalletsRequest;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Transfer\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param TransferBetweenMyWalletsRequest $request
     *
     * @return array
     */
    public function transferBetweenMyWallets(TransferBetweenMyWalletsRequest $request)
    {
        $tx = Apiato::call('Transfer@TransferBetweenMyWalletsAction', [$request]);


    }
}
