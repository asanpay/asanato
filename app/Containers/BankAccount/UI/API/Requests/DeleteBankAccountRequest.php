<?php

namespace App\Containers\BankAccount\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

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
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * @var  array
     */
    protected $decode = [
        'id',
    ];

    /**
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
            'id' => "required|exists:bank_accounts,id,user_id,{$this->user()->id}",
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
