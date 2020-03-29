<?php

namespace App\Containers\IdentityProof\UI\API\Controllers;

use App\Containers\IdentityProof\Data\Transporters\SearchInIdProofsTransporter;
use App\Containers\IdentityProof\UI\API\Requests\CreateIdentityProofRequest;
use App\Containers\IdentityProof\UI\API\Requests\DeleteIdentityProofRequest;
use App\Containers\IdentityProof\UI\API\Requests\GetAllIdentityProofsRequest;
use App\Containers\IdentityProof\UI\API\Requests\FindIdentityProofByIdRequest;
use App\Containers\IdentityProof\UI\API\Requests\GetUserIdentityProofsRequest;
use App\Containers\IdentityProof\UI\API\Requests\UpdateIdentityProofRequest;
use App\Containers\IdentityProof\UI\API\Transformers\IdentityProofTransformer;
use App\Containers\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Http\JsonResponse;

/**
 * Class Controller
 *
 * @package App\Containers\IdentityProof\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateIdentityProofRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createIdentityProof(CreateIdentityProofRequest $request)
    {
        list($msg, $err) = Apiato::call('IdentityProof@CreateIdentityProofAction', [$request]);

        if (!empty($err)) {
            return $this->message($err, 422);
        } else {
            return $this->message($msg, 201);
        }
    }

    /**
     * @param FindIdentityProofByIdRequest $request
     * @return JsonResponse
     */
    public function findIdentityProofById(FindIdentityProofByIdRequest $request)
    {
        $identityproof = Apiato::call('IdentityProof@FindIdentityProofByIdAction', [$request]);

        return $this->transform($identityproof, IdentityProofTransformer::class);
    }

    /**
     * @param GetAllIdentityProofsRequest $request
     * @return JsonResponse
     */
    public function getAllIdentityProofs(GetAllIdentityProofsRequest $request)
    {
        $identityproofs = Apiato::call('IdentityProof@GetAllIdentityProofsAction', [new SearchInIdProofsTransporter($request)]);

        return $this->transform($identityproofs, IdentityProofTransformer::class, ['media']);
    }

    public function getUserIdentityProofs(GetUserIdentityProofsRequest $request)
    {
        $dto = new SearchInIdProofsTransporter($request);
        $dto->user_id = $dto->id;

        $identityproofs = Apiato::call('IdentityProof@GetAllIdentityProofsAction', [$dto]);

        return $this->transform($identityproofs, IdentityProofTransformer::class, ['media']);
    }

    /**
     * @param UpdateIdentityProofRequest $request
     * @return JsonResponse
     */
    public function updateIdentityProof(UpdateIdentityProofRequest $request)
    {
        $identityproof = Apiato::call('IdentityProof@UpdateIdentityProofAction', [$request]);

        return $this->transform($identityproof, IdentityProofTransformer::class);
    }

    /**
     * @param DeleteIdentityProofRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteIdentityProof(DeleteIdentityProofRequest $request)
    {
        Apiato::call('IdentityProof@DeleteIdentityProofAction', [$request]);

        return $this->noContent();
    }


    public function getAuthenticatedUserIdProofs(GetAuthenticatedUserRequest $request)
    {
        $user = Apiato::call('User@GetAuthenticatedUserAction');

        return $this->json(['data' => $user->getIdProofs()]);
    }
}
