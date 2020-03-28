<?php

namespace App\Containers\IdentityProof\UI\API\Requests;

use App\Containers\IdentityProof\Enum\IdPoofType;
use App\Ship\Parents\Requests\Request;

/**
 * Class CreateIdentityProofRequest.
 */
class CreateIdentityProofRequest extends Request
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
        'permissions' => '',
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
            'id' => 'required|numeric|exists:users',
            'type'   => 'required|in:' . implode(',', IdPoofType::getConstants()),
            'file'   => 'required|mimes:jpg,jpeg,png,bmp,tiff,pdf|max:1024',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'type' => $this->get('type') ? strtoupper($this->get('type')) : $this->get('type'),
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
