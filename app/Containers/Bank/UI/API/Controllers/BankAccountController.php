<?php

namespace App\Containers\Bank\UI\API\Controllers;

use App\Containers\Bank\UI\API\Requests\CreateBankAccountRequest;
use App\Containers\Bank\UI\API\Requests\CreateBankRequest;
use App\Containers\Bank\UI\API\Requests\DeleteBankAccountRequest;
use App\Containers\Bank\UI\API\Requests\GetAllBankAccountsRequest;
use App\Containers\Bank\UI\API\Requests\GetUserBankAccountsRequest;
use App\Containers\Bank\UI\API\Transformers\BankAccountTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class BankAccountController
 *
 * @package App\Containers\Bank\UI\API\BankAccountControllers
 */
class BankAccountController extends ApiController
{
    /**
     * @param CreateBankRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBankAccount(CreateBankAccountRequest $request)
    {
        $bankAccounts = Apiato::call('Bank@CreateBankAccountAction', [$request]);

        return $this->transform(
            $bankAccounts,
            BankAccountTransformer::class,
            [], [], null, 201
        );
    }

    /**
     * @param DeleteBankAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteBankAccount(DeleteBankAccountRequest $request)
    {
        Apiato::call('Bank@DeleteBankAccountAction', [$request]);

        return $this->noContent();
    }

    /**
     * @param GetAllBankAccountsRequest $request
     * @return array
     */
    public function getAllBankAccounts(GetAllBankAccountsRequest $request)
    {
        $bankAccounts = Apiato::call('Bank@GetAllBankAccountsAction', [$request->user()]);

        return $this->transform($bankAccounts, BankAccountTransformer::class);
    }

    /**
     * @param GetUserBankAccountsRequest $request
     * @return array
     */
    public function getUserBankAccounts(GetUserBankAccountsRequest $request)
    {
        $bankAccounts = Apiato::call('Bank@GetUserBankAccountsAction', [$request->user()]);

        return $this->transform($bankAccounts, BankAccountTransformer::class);
    }
}
