<?php

namespace App\Containers\User\UI\API\Requests;

use App\Containers\User\Enum\UserGender;
use App\Containers\User\Enum\UserType;
use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateUserRequest.
 */
class UpdateUserRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var array
     */
    protected $access = [
        'permissions' => 'update-users',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var array
     */
    protected $decode = [
        'id',
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var array
     */
    protected $urlParameters = [
        'id',
    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'type'         => 'required|string|in:' . implode(',', [UserType::PERSONAL, UserType::LEGAL]),
            'company'      => 'required_if:type,' . UserType::LEGAL . '|string',
            'financial_id' => 'required_if:type,' . UserType::LEGAL . '|digits:14',
            'gender'       => 'required|in:' . implode(',', UserGender::toArray()),
            'first_name'   => 'required|string|min:2',
            'last_name'    => 'required|string|min:2',
            'national_id'  => 'required|iran_national_id',
            'email'        => 'required|email',
            'mobile'       => 'required|regex:' . config('regex.mobile_regex'),
            'tel'          => 'required|regex:' . config('regex.tel_regex'),
            'birth_date'   => 'required',
            'zip'          => 'digits:10',
            'address'      => 'required|string|min:10',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'mobile' => $this->get('mobile') ? mobilify($this->get('mobile')) : null,
                'email'  => strtolower($this->get('email')),
                'tel'    => strtolower($this->get('tel')),
                'zip'    => strtolower($this->get('zip')),
            ]
        );
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        // is this an admin who has access to permission `update-users`
        // or the user is updating his own object (is the owner).

        return $this->check(
            [
            'hasAccess|isOwner',
            ]
        );
    }
}
