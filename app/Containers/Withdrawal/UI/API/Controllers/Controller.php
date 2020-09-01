<?php

namespace App\Containers\Withdrawal\UI\API\Controllers;

use App\Containers\Withdrawal\UI\API\Requests\AccomplishWithdrawalRequest;
use App\Containers\Withdrawal\UI\API\Requests\CreateWithdrawalRequest;
use App\Containers\Withdrawal\UI\API\Requests\DeleteWithdrawalRequest;
use App\Containers\Withdrawal\UI\API\Requests\GetAllWithdrawalsRequest;
use App\Containers\Withdrawal\UI\API\Requests\FindWithdrawalByIdRequest;
use App\Containers\Withdrawal\UI\API\Requests\RejectWithdrawalRequest;
use App\Containers\Withdrawal\UI\API\Requests\UpdateWithdrawalRequest;
use App\Containers\Withdrawal\UI\API\Transformers\WithdrawalTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Withdrawal\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateWithdrawalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createWithdrawal(CreateWithdrawalRequest $request)
    {
        $withdrawal = Apiato::transactionalCall('Withdrawal@CreateWithdrawalAction', [$request]);

        return $this->transform($withdrawal, WithdrawalTransformer::class, [], [], null, 201);
    }

    /**
     * @param FindWithdrawalByIdRequest $request
     * @return array
     */
    public function findWithdrawalById(FindWithdrawalByIdRequest $request)
    {
        $withdrawal = Apiato::call('Withdrawal@FindWithdrawalByIdAction', [$request]);

        return $this->transform($withdrawal, WithdrawalTransformer::class);
    }

    /**
     * @param GetAllWithdrawalsRequest $request
     * @return array
     */
    public function getAllWithdrawals(GetAllWithdrawalsRequest $request)
    {
        $withdrawals = Apiato::call('Withdrawal@GetAllWithdrawalsAction', [$request]);

        return $this->transform($withdrawals, WithdrawalTransformer::class);
    }

    /**
     * @param UpdateWithdrawalRequest $request
     * @return array
     */
    public function updateWithdrawal(UpdateWithdrawalRequest $request)
    {
        $withdrawal = Apiato::call('Withdrawal@UpdateWithdrawalAction', [$request]);

        return $this->transform($withdrawal, WithdrawalTransformer::class);
    }

    /**
     * @param RejectWithdrawalRequest $request
     * @return array
     */
    public function rejectWithdrawal(RejectWithdrawalRequest $request)
    {
        $withdrawal = Apiato::call('Withdrawal@RejectWithdrawalAction', [$request]);

        return $this->transform($withdrawal, WithdrawalTransformer::class);
    }

    /**
     * @param AccomplishWithdrawalRequest $request
     * @return array
     */
    public function accomplishWithdrawal(AccomplishWithdrawalRequest $request)
    {
        $withdrawal = Apiato::call('Withdrawal@AccomplishWithdrawalAction', [$request]);

        return $this->transform($withdrawal, WithdrawalTransformer::class);
    }

    /**
     * @param DeleteWithdrawalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteWithdrawal(DeleteWithdrawalRequest $request)
    {
        Apiato::transactionalCall('Withdrawal@DeleteWithdrawalAction', [$request]);

        return $this->noContent();
    }
}
