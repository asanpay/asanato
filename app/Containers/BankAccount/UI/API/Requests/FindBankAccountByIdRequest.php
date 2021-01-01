<?php

namespace App\Containers\BankAccount\UI\API\Requests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Requests\Request;

/**
 * Class FindBankAccountByIdRequest.
 */
class FindBankAccountByIdRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\BankAccount\Data\Transporters\FindBankAccountByIdTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var array
     */
    protected $access = [
        'permissions' => 'read-bank-accounts',
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
            'id'      => 'required|exists:bank_accounts,id',
            'user_id' => 'required|exists:users,id',
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
        return ($this->id && Apiato::call(
            'BankAccount@FindBankAccountByIdTask',
            [$this->id]
        )->user_id == $this->user_id
        );
    }
}
