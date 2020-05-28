<?php

namespace App\Containers\User\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Data\Transporters\UserSignUpTransporter;
use App\Containers\User\Data\Transporters\UserUpdateProfileTransporter;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\User\UI\API\Requests\FindUserRequest;
use App\Containers\User\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\User\UI\API\Requests\ResetPasswordRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\User\UI\API\Requests\UserSignUpRequest;
use App\Containers\User\UI\API\Transformers\UserMinimalTransformer;
use App\Containers\User\UI\API\Transformers\UserPrivateProfileTransformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Enum\ApiCodes;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller.
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\User\UI\API\Requests\CreateAdminRequest $request
     *
     * @return  mixed
     */
    public function createAdmin(CreateAdminRequest $request)
    {
        $admin = Apiato::call('User@CreateAdminAction', [new DataTransporter($request)]);

        return $this->transform($admin, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\UpdateUserRequest $request
     *
     * @return  mixed
     */
    public function updateUser(UpdateUserRequest $request)
    {
        list($user, $err) = Apiato::call('User@UpdateUserAction', [new UserUpdateProfileTransporter($request)]);

        if (!empty($err)) {
            return $this->message($err, ApiCodes::CODE_INTERNAL_ERROR);
        } else {
            return $this->transform($user, UserPrivateProfileTransformer::class);
        }
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\DeleteUserRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleteUser(DeleteUserRequest $request)
    {
        Apiato::call('User@DeleteUserAction', [new DataTransporter($request)]);

        return $this->noContent();
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllUsers(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllUsersAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllClients(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllClientsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\GetAllUsersRequest $request
     *
     * @return  mixed
     */
    public function getAllAdmins(GetAllUsersRequest $request)
    {
        $users = Apiato::call('User@GetAllAdminsAction');

        return $this->transform($users, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\FindUserByIdRequest $request
     *
     * @return  mixed
     */
    public function findUserById(FindUserByIdRequest $request)
    {
        $user = Apiato::call('User@FindUserByIdAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param GetAuthenticatedUserRequest $request
     *
     * @return mixed
     */
    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request)
    {
        $user = Apiato::call('User@GetAuthenticatedUserAction');

        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\ResetPasswordRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        list ($msg, $err) = Apiato::call('User@ResetPasswordAction', [new DataTransporter($request)]);

        if (!empty($err)) {
            return $this->message($err, ApiCodes::CODE_INTERNAL_ERROR);
        }

        return $this->noContent(204);
    }

    /**
     * @param UserSignUpRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signUp(UserSignUpRequest $request)
    {
        $t = new UserSignUpTransporter($request);

        list ($result, $err) = Apiato::call('User@UserSignUpAction', [$t]);

        if (empty($err)) {
            return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
        } else {
            return $this->apiCode($result)->message($err, ApiCodes::UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\FindUserByIdRequest $request
     *
     * @return  mixed
     */
    public function findUser(FindUserRequest $request)
    {
        $user = Apiato::call('User@FindUserAction', [$request->keyword]);

        if ($user) {
            return $this->transform($user, UserMinimalTransformer::class);
        } else {
            throw new UserNotFoundException();
        }
    }
}
