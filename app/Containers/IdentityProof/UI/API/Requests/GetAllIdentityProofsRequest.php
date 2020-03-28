<?php

namespace App\Containers\IdentityProof\UI\API\Requests;

use App\Containers\IdentityProof\Enum\IdPoofType;
use App\Containers\IdentityProof\Enum\IdProofStatus;
use App\Ship\Parents\Requests\Request;

/**
 * Class GetAllIdentityProofsRequest.
 */
class GetAllIdentityProofsRequest extends Request
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
        dd($this->all());
        return [
            'id' => 'required|numeric|exists:users',
            //            'proof_type' => 'required|in:' . implode(',', IdPoofType::toArray()),
            //            'status' => 'required|in:' . implode(',', IdProofStatus::toArray()),
        ];
    }

    public function prepareForValidation()
    {
        $search = $this->get('search');
        if (!empty($search)) {
            $criteria = explode(';', $search);
            foreach ($criteria as $index => $cond) {
                list ($field, $val) = explode(':', $cond);
                if ($field == 'proof_type') {
                    $val              = IdPoofType::value($val);
                    $criteria[$index] = $field . ':' . $val;
                    break;
                }
            }
            $search = implode(';', $criteria);
        }

        $this->merge(
            [
                'search' => $search
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
