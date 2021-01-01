<?php

namespace App\Containers\Helpdesk\UI\API\Controllers;

use App\Containers\Helpdesk\UI\API\Requests\CreateHelpdeskRequest;
use App\Containers\Helpdesk\UI\API\Requests\DeleteHelpdeskRequest;
use App\Containers\Helpdesk\UI\API\Requests\GetAllHelpdesksRequest;
use App\Containers\Helpdesk\UI\API\Requests\FindHelpdeskByIdRequest;
use App\Containers\Helpdesk\UI\API\Requests\UpdateHelpdeskRequest;
use App\Containers\Helpdesk\UI\API\Transformers\HelpdeskTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Helpdesk\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param  CreateHelpdeskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createHelpdesk(CreateHelpdeskRequest $request)
    {
        $helpdesk = Apiato::call('Helpdesk@CreateHelpdeskAction', [$request]);

        return $this->created($this->transform($helpdesk, HelpdeskTransformer::class));
    }

    /**
     * @param  FindHelpdeskByIdRequest $request
     * @return array
     */
    public function findHelpdeskById(FindHelpdeskByIdRequest $request)
    {
        $helpdesk = Apiato::call('Helpdesk@FindHelpdeskByIdAction', [$request]);

        return $this->transform($helpdesk, HelpdeskTransformer::class);
    }

    /**
     * @param  GetAllHelpdesksRequest $request
     * @return array
     */
    public function getAllHelpdesks(GetAllHelpdesksRequest $request)
    {
        $helpdesks = Apiato::call('Helpdesk@GetAllHelpdesksAction', [$request]);

        return $this->transform($helpdesks, HelpdeskTransformer::class);
    }

    /**
     * @param  UpdateHelpdeskRequest $request
     * @return array
     */
    public function updateHelpdesk(UpdateHelpdeskRequest $request)
    {
        $helpdesk = Apiato::call('Helpdesk@UpdateHelpdeskAction', [$request]);

        return $this->transform($helpdesk, HelpdeskTransformer::class);
    }

    /**
     * @param  DeleteHelpdeskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteHelpdesk(DeleteHelpdeskRequest $request)
    {
        Apiato::call('Helpdesk@DeleteHelpdeskAction', [$request]);

        return $this->noContent();
    }
}
