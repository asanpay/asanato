<?php

namespace App\Containers\BankAccount\UI\API\Controllers;

use App\Containers\BankAccount\UI\API\Requests\FindBankAccountByIdRequest;
use App\Containers\BankAccount\UI\API\Requests\GetUserBankAccountsRequest;
use App\Containers\BankAccount\UI\API\Requests\CreateBankAccountRequest;
use App\Containers\BankAccount\UI\API\Requests\DeleteBankAccountRequest;
use App\Containers\BankAccount\UI\API\Requests\GetAllBankAccountsRequest;
use App\Containers\BankAccount\UI\API\Requests\UpdateBankAccountRequest;
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
        return $this->message('delete bank account has not implemented yet', 501);

        Apiato::transactionalCall('BankAccount@DeleteBankAccountAction', [$request]);

        return $this->noContent();
    }

    /**
     * @param UpdateBankAccountRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateBankAccount(UpdateBankAccountRequest $request)
    {
        $bankAccounts = Apiato::call('BankAccount@UpdateBankAccountAction', [$request]);

        return $this->transform($bankAccounts, BankAccountTransformer::class);
    }

    /**
     * @param GetAllBankAccountsRequest $request
     *
     * @return array
     */
    public function getAllBankAccounts(GetAllBankAccountsRequest $request)
    {
        $bankAccounts = Apiato::call('BankAccount@GetBankAccountsAction', [$request->user()]);

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

    /**
     * @param FindBankAccountByIdRequest $request
     *
     * @return mixed
     */
    public function findUserAccountById(FindBankAccountByIdRequest $request)
    {
        $bankAccounts = Apiato::call('BankAccount@FindBankAccountByIdAction', [$request->id]);

        return $this->transform($bankAccounts, BankAccountTransformer::class);
    }
}
