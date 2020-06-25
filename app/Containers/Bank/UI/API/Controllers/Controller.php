<?php

namespace App\Containers\Bank\UI\API\Controllers;

use App\Containers\Bank\UI\API\Requests\CreateBankAccountRequest;
use App\Containers\Bank\UI\API\Requests\CreateBankRequest;
use App\Containers\Bank\UI\API\Requests\DeleteBankAccountRequest;
use App\Containers\Bank\UI\API\Requests\DeleteBankRequest;
use App\Containers\Bank\UI\API\Requests\GetAllBankAccountsRequest;
use App\Containers\Bank\UI\API\Requests\GetAllBanksRequest;
use App\Containers\Bank\UI\API\Requests\FindBankByIdRequest;
use App\Containers\Bank\UI\API\Requests\GetUserBankAccountsRequest;
use App\Containers\Bank\UI\API\Requests\UpdateBankRequest;
use App\Containers\Bank\UI\API\Transformers\BankAccountTransformer;
use App\Containers\Bank\UI\API\Transformers\BankTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Bank\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateBankRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBank(CreateBankRequest $request)
    {
        $bank = Apiato::call('Bank@CreateBankAction', [$request]);

        return $this->created($this->transform($bank, BankTransformer::class));
    }

    /**
     * @param FindBankByIdRequest $request
     * @return array
     */
    public function findBankById(FindBankByIdRequest $request)
    {
        $bank = Apiato::call('Bank@FindBankByIdAction', [$request]);

        return $this->transform($bank, BankTransformer::class);
    }

    /**
     * @param GetAllBanksRequest $request
     * @return array
     */
    public function getAllBanks(GetAllBanksRequest $request)
    {
        $banks = Apiato::call('Bank@GetAllBanksAction', [$request]);

        return $this->transform($banks, BankTransformer::class);
    }

    /**
     * @param UpdateBankRequest $request
     * @return array
     */
    public function updateBank(UpdateBankRequest $request)
    {
        $bank = Apiato::call('Bank@UpdateBankAction', [$request]);

        return $this->transform($bank, BankTransformer::class);
    }

    /**
     * @param DeleteBankRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteBank(DeleteBankRequest $request)
    {
        Apiato::call('Bank@DeleteBankAction', [$request]);

        return $this->noContent();
    }

    // bank accounts ===================================================================================================
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
