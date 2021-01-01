<?php

namespace App\Containers\Transaction\UI\API\Controllers;

use App\Containers\Transaction\UI\API\Requests\CreateTransactionRequest;
use App\Containers\Transaction\UI\API\Requests\DeleteTransactionRequest;
use App\Containers\Transaction\UI\API\Requests\GetAllTransactionsRequest;
use App\Containers\Transaction\UI\API\Requests\FindTransactionByIdRequest;
use App\Containers\Transaction\UI\API\Requests\UpdateTransactionRequest;
use App\Containers\Transaction\UI\API\Transformers\TransactionTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Transaction\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param  CreateTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTransaction(CreateTransactionRequest $request)
    {
        $transaction = Apiato::call('Transaction@CreateTransactionAction', [$request]);

        return $this->created($this->transform($transaction, TransactionTransformer::class));
    }

    /**
     * @param  FindTransactionByIdRequest $request
     * @return array
     */
    public function findTransactionById(FindTransactionByIdRequest $request)
    {
        $transaction = Apiato::call('Transaction@FindTransactionByIdAction', [$request]);

        return $this->transform($transaction, TransactionTransformer::class);
    }

    /**
     * @param  GetAllTransactionsRequest $request
     * @return array
     */
    public function getAllTransactions(GetAllTransactionsRequest $request)
    {
        $transactions = Apiato::call('Transaction@GetAllTransactionsAction', [$request]);

        return $this->transform($transactions, TransactionTransformer::class);
    }

    /**
     * @param  UpdateTransactionRequest $request
     * @return array
     */
    public function updateTransaction(UpdateTransactionRequest $request)
    {
        $transaction = Apiato::call('Transaction@UpdateTransactionAction', [$request]);

        return $this->transform($transaction, TransactionTransformer::class);
    }

    /**
     * @param  DeleteTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTransaction(DeleteTransactionRequest $request)
    {
        Apiato::call('Transaction@DeleteTransactionAction', [$request]);

        return $this->noContent();
    }
}
