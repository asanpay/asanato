<?php

namespace App\Containers\Otp\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Config;

/**
 * Class VerifyOtpRequest.
 */
class VerifyOtpRequest extends Request
{

    /**
     * @return array
     */
    public function rules()
    {
        $brokers = Config::get('otp-container.brokers');

        $all = [];
        foreach ($brokers as $broker => $reasons) {
            $all[] = $reasons;
        }

        return [
            'token'  => 'required|digits_between:4,6',
            'reason' => 'nullable|in:' . implode(',', $all),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'token' => english($this->get('token')),
            ]
        );
    }
}
