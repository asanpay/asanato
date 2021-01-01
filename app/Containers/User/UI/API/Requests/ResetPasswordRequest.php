<?php

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class ResetPasswordRequest.
 */
class ResetPasswordRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var array
     */
    protected $access = [
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var array
     */
    protected $decode = [
        // 'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var array
     */
    protected $urlParameters = [

    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'token'    => 'required|max:4',
            'mobile'   => 'required|regex:' . config('regex.mobile_regex'),
            'password' => 'required|string|confirmed|min:6|max:40',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'mobile' => $this->get('mobile') ? mobilify($this->get('mobile')) : $this->get('mobile'),
            ]
        );
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return $this->check(
            [
            'hasAccess',
            ]
        );
    }
}
