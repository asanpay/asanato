<?php

namespace App\Containers\Wallet\UI\API\Requests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateWalletRequest.
 */
class UpdateWalletRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Wallet\Data\Transporters\UpdateWalletTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'update-wallets',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        'id',
        'user_id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        'id',
        'user_id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'id'      => 'required|numeric|exists:wallets',
            'name'    => 'nullable|string|min:1|max:64',
            'default' => 'nullable|boolean',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'default' => $this->has('default') ? filter_var($this->get('default'), FILTER_VALIDATE_BOOLEAN) : null,
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

    public function isOwner()
    {
        return (Apiato::call('Wallet@FindWalletByIdTask', [$this->id])->user_id == $this->user_id);
    }
}
