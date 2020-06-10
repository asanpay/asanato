<?php

namespace App\Containers\Otp\UI\API\Controllers;

use App\Containers\Otp\Exceptions\GoogleAuthNotSetBeforeException;
use App\Containers\IdentityProof\Exceptions\UserMobileNotProvedException;
use App\Containers\Otp\Data\Transporters\CreateOtpTokenTransporter;
use App\Containers\Otp\UI\API\Requests\CreateOtpRequest;
use App\Containers\Otp\UI\API\Requests\SetUserGoogleAuthRequest;
use App\Containers\Otp\UI\API\Requests\VerifyGuestOtpRequest;
use App\Containers\Otp\UI\API\Requests\VerifyOtpRequest;
use App\Containers\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\User\UI\API\Transformers\UserQrCodeTransformer;
use App\Ship\Enum\ApiCodes;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller
 *
 * @package App\Containers\Otp\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateOtpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOtp(CreateOtpRequest $request)
    {
        $t = new CreateOtpTokenTransporter(array_merge($request->all(), [
            'ip' => $request->ip(),
            'to' => $request->has('mobile') ? $request->has('mobile') : $request->has('email'),
        ]));

        list ($message, $err) = Apiato::call('Otp@SendOtpAction', [$t]);

        if (empty($err)) {
            return $this->message($message);
        } else {
            return $this->message($err, ApiCodes::TOO_MANY_REQUESTS);
        }
    }

    /**
     * @param VerifyGuestOtpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyGuestOtpToken(VerifyGuestOtpRequest $request)
    {
        $validity = Apiato::call('Otp@VerifyGuestOtpAction', [new DataTransporter($request)]);

        if ($validity) {
            return $this->noContent();
        } else {
            return $this->message(__('auth.invalid_otp'), 400);
        }
    }

    /**
     * @param VerifyOtpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOtpToken(VerifyOtpRequest $request)
    {
        $validity = Apiato::call('Otp@VerifyOtpAction', [$request->user(), $request->token, $request->reason]);

        if ($validity) {
            return $this->noContent();
        } else {
            return $this->message(__('auth.invalid_otp'), 400);
        }
    }

    /**
     * @param GetAuthenticatedUserRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTempGoogleAuth(GetAuthenticatedUserRequest $request)
    {
        $data = Apiato::call('Otp@GetTempGoogleAuthDataAction', [$request->user()]);

        return $this->apocalypse(['data' => $data], 200);
    }

    /**
     * @param SetUserGoogleAuthRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setUserGoogleAuth(SetUserGoogleAuthRequest $request)
    {
        $data = Apiato::call('Otp@SetUserGoogleAuthAction', [$request->user(), $request->token]);

        return $this->noContent();
    }

    /**
     * @param GetAuthenticatedUserRequest $request
     *
     * @return mixed
     */
    public function getGoogleAuthQrCode(GetAuthenticatedUserRequest $request)
    {
        $user = $request->user();

        if ($user->isProvedMobile() !== true) {
            // just users with proved mobile could get QrCode
            throw new UserMobileNotProvedException();
        }

        if (empty($user->getGoogleAuthSecret())) {
            throw new GoogleAuthNotSetBeforeException();
        }

        return $this->transform($user, UserQrCodeTransformer::class);
    }
}
