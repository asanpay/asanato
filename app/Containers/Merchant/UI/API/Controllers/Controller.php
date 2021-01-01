<?php

namespace App\Containers\Merchant\UI\API\Controllers;

use App\Containers\Merchant\UI\API\Requests\CreateMerchantRequest;
use App\Containers\Merchant\UI\API\Requests\DeleteMerchantRequest;
use App\Containers\Merchant\UI\API\Requests\GetAllMerchantsRequest;
use App\Containers\Merchant\UI\API\Requests\FindMerchantByIdRequest;
use App\Containers\Merchant\UI\API\Requests\UpdateMerchantRequest;
use App\Containers\Merchant\UI\API\Transformers\MerchantTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Merchant\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param  CreateMerchantRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMerchant(CreateMerchantRequest $request)
    {
        $merchant = Apiato::transactionalCall('Merchant@CreateMerchantAction', [$request]);

        return $this->transform($merchant, MerchantTransformer::class, [], [], null, 201);

        //        return $this->created($this->transform($merchant, MerchantTransformer::class));
    }

    /**
     * @param  FindMerchantByIdRequest $request
     * @return array
     */
    public function findMerchantById(FindMerchantByIdRequest $request)
    {
        $merchant = Apiato::call('Merchant@FindMerchantByIdAction', [$request]);

        return $this->transform($merchant, MerchantTransformer::class);
    }

    /**
     * @param  GetAllMerchantsRequest $request
     * @return array
     */
    public function getAllMerchants(GetAllMerchantsRequest $request)
    {
        $merchants = Apiato::call('Merchant@GetAllMerchantsAction', [$request]);

        return $this->transform($merchants, MerchantTransformer::class);
    }

    /**
     * @param  UpdateMerchantRequest $request
     * @return array
     */
    public function updateMerchant(UpdateMerchantRequest $request)
    {
        $merchant = Apiato::call('Merchant@UpdateMerchantAction', [$request]);

        return $this->transform($merchant, MerchantTransformer::class);
    }

    /**
     * @param  DeleteMerchantRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMerchant(DeleteMerchantRequest $request)
    {
        Apiato::call('Merchant@DeleteMerchantAction', [$request]);

        return $this->noContent();
    }
}
