<?php

namespace App\Containers\Otp\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Config;

/**
 * Class VerifyOtpRequest.
 */
class VerifyGuestOtpRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {
        $brokers = Config::get('otp-container.brokers');

        $all = [];
        foreach ($brokers as $broker => $reasons) {
            $all[] = $reasons;
        }

        return [
            'reason' => 'required|in:'.implode(',', $all),
            'mobile' => 'nullable|regex:'.config('regex.mobile_regex').'|required_if:reason,'.$brokers['mobile'],
            'email'  => 'nullable|email|required_if:reason,'.$brokers['email'],
            'token'  => 'required|digits:4',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'mobile' => $this->get('mobile') ? mobilify($this->get('mobile')) : $this->get('mobile'),
                'email'  => $this->get('email') ? strtolower($this->get('email')) : $this->get('email'),
            ]
        );
    }
}
