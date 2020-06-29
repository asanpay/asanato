<?php

namespace App\Containers\BankAccount\UI\API\Requests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\BankAccount\Enum\BankAccountStatus;
use App\Ship\Parents\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateBankAccountRequest.
 */
class UpdateBankAccountRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\BankAccount\Data\Transporters\UpdateBankAccountTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => 'update-bank-accounts',
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
        'bank_id',
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
            'id'      => 'required|exists:bank_accounts,id',
            'iban'    => [
                'nullable',
                'digits:24',
                Rule::unique('bank_accounts')->where(function ($query) {
                    return $query->where('status', BankAccountStatus::APPROVED)
                        ->whereNull('deleted_at');
                }),
            ],
            'user_id' => 'required|exists:users,id',
            'bank_id' => 'required|exists:banks,id',
            'status'  => 'nullable|in:' . BankAccountStatus::commaSeparated(),
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
        return ($this->id && Apiato::call('BankAccount@FindBankAccountByIdTask', [$this->id])->user_id == $this->user_id);
    }
}
