<?php

namespace App\Containers\Transfer\UI\API\Controllers;

use App\Containers\Transfer\UI\API\Requests\TransferBetweenMyWalletsRequest;
use App\Containers\Transfer\UI\API\Requests\TransferToOthersWalletsRequest;
use App\Containers\Transfer\UI\API\Requests\TransferToOtherUserRequest;
use App\Containers\Tx\UI\API\Transformers\TxTransformer;
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
     * @param TransferToOthersWalletsRequest $request
     *
     * @return array
     */
    public function transferBetweenWallets(TransferToOthersWalletsRequest $request)
    {
        $tx = Apiato::call('Transfer@TransferToOthersWalletsAction', [$request]);

        return $this->transform($tx, TxTransformer::class);
    }

    /**
     * @param TransferToOtherUserRequest $request
     *
     * @return array
     */
    public function transferToOtherUser(TransferToOtherUserRequest $request)
    {
        $tx = Apiato::call('Transfer@TransferToOtherUserAction', [$request]);

        return $this->transform($tx, TxTransformer::class);
    }
}
