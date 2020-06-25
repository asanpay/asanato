<?php

namespace App\Containers\BankAccount\UI\API\Controllers;

use App\Containers\BankAccount\UI\API\Requests\GetUserBankAccountsRequest;
use App\Containers\BankAccount\UI\API\Requests\CreateBankAccountRequest;
use App\Containers\BankAccount\UI\API\Requests\DeleteBankAccountRequest;
use App\Containers\BankAccount\UI\API\Requests\GetAllBankAccountsRequest;
use App\Containers\BankAccount\UI\API\Transformers\BankAccountTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\BankAccount\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateBankAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBankAccount(CreateBankAccountRequest $request)
    {
        $bankAccounts = Apiato::call('BankAccount@CreateBankAccountAction', [$request]);

        return $this->transform(
            $bankAccounts,
            BankAccountTransformer::class,
            [], [], null, 201
        );
    }

    /**
     * @param DeleteBankAccountRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteBankAccount(DeleteBankAccountRequest $request)
    {
        Apiato::call('BankAccount@DeleteBankAccountAction', [$request]);

        return $this->noContent();
    }

    /**
     * @param GetAllBankAccountsRequest $request
     *
     * @return array
     */
    public function getAllBankAccounts(GetAllBankAccountsRequest $request)
    {
        $bankAccounts = Apiato::call('BankAccount@GetAllBankAccountsAction', [$request->user()]);

        return $this->transform($bankAccounts, BankAccountTransformer::class);
    }

    /**
     * @param GetUserBankAccountsRequest $request
     * @return array
     */
    public function getUserBankAccounts(GetUserBankAccountsRequest $request)
    {
        $bankAccounts = Apiato::call('BankAccount@GetUserBankAccountsAction', [$request->user()]);

        return $this->transform($bankAccounts, BankAccountTransformer::class);
    }
}
