<?php

namespace App\Containers\Tx\UI\API\Controllers;

use App\Containers\Tx\UI\API\Requests\CreateTxRequest;
use App\Containers\Tx\UI\API\Requests\DeleteTxRequest;
use App\Containers\Tx\UI\API\Requests\GetAllTxesRequest;
use App\Containers\Tx\UI\API\Requests\FindTxByIdRequest;
use App\Containers\Tx\UI\API\Requests\UpdateTxRequest;
use App\Containers\Tx\UI\API\Transformers\TxTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Tx\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateTxRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTx(CreateTxRequest $request)
    {
        $tx = Apiato::call('Tx@CreateTxAction', [$request]);

        return $this->created($this->transform($tx, TxTransformer::class));
    }

    /**
     * @param FindTxByIdRequest $request
     * @return array
     */
    public function findTxById(FindTxByIdRequest $request)
    {
        $tx = Apiato::call('Tx@FindTxByIdAction', [$request]);

        return $this->transform($tx, TxTransformer::class);
    }

    /**
     * @param GetAllTxesRequest $request
     * @return array
     */
    public function getAllTxes(GetAllTxesRequest $request)
    {
        $txes = Apiato::call('Tx@GetAllTxesAction', [$request]);

        return $this->transform($txes, TxTransformer::class);
    }

    /**
     * @param UpdateTxRequest $request
     * @return array
     */
    public function updateTx(UpdateTxRequest $request)
    {
        $tx = Apiato::call('Tx@UpdateTxAction', [$request]);

        return $this->transform($tx, TxTransformer::class);
    }

    /**
     * @param DeleteTxRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTx(DeleteTxRequest $request)
    {
        Apiato::call('Tx@DeleteTxAction', [$request]);

        return $this->noContent();
    }
}
