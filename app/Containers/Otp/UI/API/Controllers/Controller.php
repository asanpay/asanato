<?php

namespace App\Containers\Otp\UI\API\Controllers;

use App\Containers\Otp\Data\Transporters\CreateOtpTokenTransporter;
use App\Containers\Otp\UI\API\Requests\CreateOtpRequest;
use App\Containers\Otp\UI\API\Requests\VerifyOtpRequest;
use App\Containers\Otp\UI\API\Transformers\OtpTransformer;
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
        $t = new CreateOtpTokenTransporter(array_merge($request->all(),[
            'ip' => $request->ip(),
            'to' => $request->has('mobile') ? $request->has('mobile') : $request->has('email')
        ]));

        list ($message, $err) = Apiato::call('Otp@SendOtpAction', [$t]);

        if (empty($err)) {
            return $this->message($message);
        } else {
            return $this->message($err, ApiCodes::TOO_MANY_REQUESTS);
        }
    }

    /**
     * @param FindOtpByIdRequest $request
     * @return array
     */
    public function findOtpById(FindOtpByIdRequest $request)
    {
        $otp = Apiato::call('Otp@FindOtpByIdAction', [$request]);

        return $this->transform($otp, OtpTransformer::class);
    }

    /**
     * @param GetAllOtpsRequest $request
     * @return array
     */
    public function getAllOtps(GetAllOtpsRequest $request)
    {
        $otps = Apiato::call('Otp@GetAllOtpsAction', [$request]);

        return $this->transform($otps, OtpTransformer::class);
    }

    /**
     * @param UpdateOtpRequest $request
     * @return array
     */
    public function updateOtp(UpdateOtpRequest $request)
    {
        $otp = Apiato::call('Otp@UpdateOtpAction', [$request]);

        return $this->transform($otp, OtpTransformer::class);
    }

    /**
     * @param DeleteOtpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOtp(DeleteOtpRequest $request)
    {
        Apiato::call('Otp@DeleteOtpAction', [$request]);

        return $this->noContent();
    }


    public function verifyOtpToken(VerifyOtpRequest $request)
    {
        list ($_, $err) = Apiato::call('Otp@VerifyOtpAction', [new DataTransporter($request)]);

        if (empty($err)) {
            return $this->noContent();
        } else {
            return $this->message($err);
        }
    }
}
