<?php

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UserSignupRequest
 * @package App\Containers\User\UI\API\Requests
 */
class UserSignUpRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
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
        return [
            'code'       => 'required|digits:4',
            'first_name' => 'required|string|min:2',
            'last_name'  => 'required|string|min:2',
            'mobile'     => 'required|regex:' . config('regex.mobile_regex'),
            'password'   => 'required|string|min:8',
            'client_ip'  => 'ip'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'client_ip' => request('client_ip', request()->ip()),
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
