<?php

namespace App\Containers\Wallet\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateWalletRequest.
 */
class CreateWalletRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Wallet\Data\Transporters\CreateWalletTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var array
     */
    protected $decode = [
        'payer_wallet_id',
    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => 'required|string|min:1|max:64',
            'default'         => 'nullable|boolean',
            'payer_wallet_id' => 'nullable|numeric|exists:wallets,id',
        ];
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
