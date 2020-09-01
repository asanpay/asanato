<?php

namespace App\Containers\Withdrawal\UI\API\Requests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Withdrawal\Enum\WithdrawalStatus;
use App\Ship\Parents\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class DeleteWithdrawalRequest.
 */
class DeleteWithdrawalRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Withdrawal\Data\Transporters\DeleteWithdrawalTransporter::class;

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
        $id = $this->id;

        return [
            'id' => [
                'required',
                Rule::exists('withdrawals')->where(function ($query) use ($id) {
                    $query->where('id', $id)
                        ->where('status', '<=', WithdrawalStatus::PROCESSING);
                }),
            ],
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

    /**
     * @return bool
     */
    public function isOwner()
    {
        return ($this->id && Apiato::call('Withdrawal@FindWithdrawalByIdTask',
                [$this->id])->user_id == $this->user()->id);
    }
}
