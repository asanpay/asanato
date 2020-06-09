<?php

namespace App\Containers\Wallet\UI\API\Controllers;

use App\Containers\Wallet\UI\API\Requests\CreateWalletRequest;
use App\Containers\Wallet\UI\API\Requests\DeleteWalletRequest;
use App\Containers\Wallet\UI\API\Requests\GetAllWalletsRequest;
use App\Containers\Wallet\UI\API\Requests\FindWalletByIdRequest;
use App\Containers\Wallet\UI\API\Requests\GetUserWalletsRequest;
use App\Containers\Wallet\UI\API\Requests\TopUpWalletRequest;
use App\Containers\Wallet\UI\API\Requests\UpdateWalletRequest;
use App\Containers\Wallet\UI\API\Transformers\TxTransformer;
use App\Containers\Wallet\UI\API\Transformers\WalletTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Fractal;

/**
 * Class Controller
 *
 * @package App\Containers\Wallet\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateWalletRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createWallet(CreateWalletRequest $request)
    {
        $wallet            = Apiato::call('Wallet@CreateWalletAction', [$request]);
        $transformedWallet = Fractal::create($wallet, WalletTransformer::class);
        $data              = [
            'wallet' => $transformedWallet->toArray()['data'],
        ];

        if ($request->payer_wallet_id) {
            $payerWallet           = Apiato::call('Wallet@FindWalletByIdTask', [$request->payer_wallet_id]);
            $transformedWallet     = Fractal::create($payerWallet, WalletTransformer::class);
            $data ['payer_wallet'] = $transformedWallet->toArray()['data'];
        }

        return $this->apocalypse(['data' => $data], 201);
    }

    /**
     * @param FindWalletByIdRequest $request
     *
     * @return array
     */
    public function findWalletById(FindWalletByIdRequest $request)
    {
        $wallet = Apiato::call('Wallet@FindWalletByIdAction', [$request]);

        return $this->transform($wallet, WalletTransformer::class);
    }

    /**
     * @param GetAllWalletsRequest $request
     *
     * @return array
     */
    public function getAllWallets(GetAllWalletsRequest $request)
    {
        $wallets = Apiato::call('Wallet@GetAllWalletsAction', [$request]);

        return $this->transform($wallets, WalletTransformer::class);
    }

    /**
     * @param UpdateWalletRequest $request
     *
     * @return array
     */
    public function updateWallet(UpdateWalletRequest $request)
    {
        $wallet = Apiato::call('Wallet@UpdateWalletAction', [$request]);

        return $this->transform($wallet, WalletTransformer::class);
    }

    /**
     * @param DeleteWalletRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteWallet(DeleteWalletRequest $request)
    {
        Apiato::call('Wallet@DeleteWalletAction', [$request]);

        return $this->noContent();
    }

    /**
     * @param GetUserWalletsRequest $request
     *
     * @return array
     */
    public function getUserWallets(GetUserWalletsRequest $request)
    {
        $wallets = Apiato::call('Wallet@GetUserWalletsAction', [$request]);

        return $this->transform($wallets, WalletTransformer::class);
    }

    /**
     * @param TopUpWalletRequest $request
     *
     * @return JsonResponse
     */
    public function topUpWallet(TopUpWalletRequest $request)
    {
        $transaction = Apiato::call('Wallet@GetTopUpWalletPaymentTokenAction', [$request]);

        return $this->apocalypse($transaction, 201);
    }
}
