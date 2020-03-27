<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Config;

/**
 * Class VerifyOtpRequest.
 */
class VerifyOtpRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        $brokers = Config::get('authorization-container.otp.brokers');

        $all = [];
        foreach ($brokers as $broker => $reasons) {
            $all[] = $reasons;
        }

        return [
            'reason' => 'required|in:' . implode(',', $all),
            'mobile' => 'nullable|regex:' . config('regex.mobile_regex') . '|required_if:reason,' . $brokers['mobile'],
            'email'  => 'nullable|email|required_if:reason,' . $brokers['email'],
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

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
