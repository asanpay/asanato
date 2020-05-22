<?php

namespace App\Containers\Transfer\UI\API\Controllers;

use App\Containers\Transfer\UI\API\Requests\TransferBetweenMyWalletsRequest;
use App\Containers\Wallet\UI\API\Transformers\TxTransformer;
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

        return $this->transform($tx, TxTransformer::class);
    }

    /**
     * @param TransferBetweenMyWalletsRequest $request
     *
     * @return array
     */
    public function transferBetweenWallets(TransferBetweenWalletsRequest $request)
    {
        $tx = Apiato::call('Transfer@TransferBetweenWalletsAction', [$request]);

        return $this->transform($tx, TxTransformer::class);
    }
}
