<?php

namespace App\Containers\BankAccount\UI\API\Requests;

use App\Containers\BankAccount\Enum\BankAccountStatus;
use App\Ship\Parents\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class CreateBankAccountRequest.
 */
class CreateBankAccountRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'create-bank-accounts',
        'roles'       => '',
    ];

    protected $decode = [
        'user_id',
        'bank_id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'iban'    => [
                'required',
                'digits:24',
                Rule::unique('bank_accounts')->where(function ($query) {
                    return $query->where('status', BankAccountStatus::APPROVED)
                        ->whereNull('deleted_at');
                }),
            ],
            'default' => 'nullable|boolean',
            'user_id' => 'nullable|exists:users,id',
            'bank_id' => 'nullable|exists:banks,id',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'iban' => $this->get('iban') ? substr($this->get('iban'), -24) : $this->get('iban'),
            ]
        );
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
