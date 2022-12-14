<?php

namespace App\Containers\Wallet\UI\API\Requests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Requests\Request;

/**
 * Class DeleteWalletRequest.
 */
class DeleteWalletRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Wallet\Data\Transporters\DeleteWalletTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var array
     */
    protected $access = [
        'permissions' => 'delete-wallets',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var array
     */
    protected $decode = [
        'id',
        'user_id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var array
     */
    protected $urlParameters = [
        'id',
        'user_id',
    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:wallets,id',
            'user_id' => 'required|numeric|exists:users,id',
        ];
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return $this->check(
            [
            'hasAccess|isOwner',
            ]
        );
    }

    public function isOwner()
    {
        return (Apiato::call('Wallet@FindWalletByIdTask', [$this->id])->user_id == $this->user_id);
    }
}
