<?php

namespace App\Containers\Profile\UI\API\Controllers;

use App\Containers\Profile\UI\API\Requests\CreateProfileRequest;
use App\Containers\Profile\UI\API\Requests\DeleteProfileRequest;
use App\Containers\Profile\UI\API\Requests\GetAllProfilesRequest;
use App\Containers\Profile\UI\API\Requests\FindProfileByIdRequest;
use App\Containers\Profile\UI\API\Requests\UpdateProfileRequest;
use App\Containers\Profile\UI\API\Transformers\ProfileTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Profile\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createProfile(CreateProfileRequest $request)
    {
        $profile = Apiato::call('Profile@CreateProfileAction', [$request]);

        return $this->created($this->transform($profile, ProfileTransformer::class));
    }

    /**
     * @param FindProfileByIdRequest $request
     * @return array
     */
    public function findProfileById(FindProfileByIdRequest $request)
    {
        $profile = Apiato::call('Profile@FindProfileByIdAction', [$request]);

        return $this->transform($profile, ProfileTransformer::class);
    }

    /**
     * @param GetAllProfilesRequest $request
     * @return array
     */
    public function getAllProfiles(GetAllProfilesRequest $request)
    {
        $profiles = Apiato::call('Profile@GetAllProfilesAction', [$request]);

        return $this->transform($profiles, ProfileTransformer::class);
    }

    /**
     * @param UpdateProfileRequest $request
     * @return array
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $profile = Apiato::call('Profile@UpdateProfileAction', [$request]);

        return $this->transform($profile, ProfileTransformer::class);
    }

    /**
     * @param DeleteProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProfile(DeleteProfileRequest $request)
    {
        Apiato::call('Profile@DeleteProfileAction', [$request]);

        return $this->noContent();
    }
}
