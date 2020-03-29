<?php

namespace App\Containers\IdentityProof\UI\API\Requests;

use App\Containers\IdentityProof\Enum\IdPoofType;
use App\Containers\IdentityProof\Enum\IdProofStatus;
use App\Ship\Parents\Requests\Request;

/**
 * Class GetAllIdentityProofsRequest.
 */
class GetUserIdentityProofsRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    // protected $transporter = \App\Ship\Transporters\DataTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'read-users',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'id' => 'nullable|numeric|exists:users',
            'type' => 'nullable|in:' . implode(',', IdPoofType::toArray()),
            'status' => 'nullable|in:' . implode(',', IdProofStatus::toArray()),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'type' => $this->has('type') ? IdPoofType::value($this->get('type')) : $this->has('type'),
                'status' => strtoupper($this->get('status', '')),
            ]
        );
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess|isOwner',
        ]);
    }
}
