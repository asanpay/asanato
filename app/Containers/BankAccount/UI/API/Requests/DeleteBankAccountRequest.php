<?php

namespace App\Containers\BankAccount\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class DeleteBankAccountRequest.
 */
class DeleteBankAccountRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'delete-bank-accounts',
        'roles'       => '',
    ];

    /**
     * @var  array
     */
    protected $decode = [
        'id',
        'user_id',
    ];

    /**
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
            'id'      => 'required|exists:bank_accounts,id',
            'user_id' => 'required|exists:users,id',
        ];
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
      return (Apiato::call('BankAccount@FindBankAccountByIdTask', [$this->id])->user_id == $this->user_id);
    }
}
