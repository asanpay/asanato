<?php

namespace App\Containers\Withdrawal\UI\API\Requests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Requests\Request;

/**
 * Class FindWithdrawalByIdRequest.
 */
class FindWithdrawalByIdRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Withdrawal\Data\Transporters\FindWithdrawalByIdTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var array
     */
    protected $access = [
        'permissions' => 'read-withdrawals',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var array
     */
    protected $decode = [
        'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var array
     */
    protected $urlParameters = [
        'id',
    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:withdrawals',
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

    /**
     * @return bool
     */
    public function isOwner()
    {
        return ($this->id && Apiato::call(
            'Withdrawal@FindWithdrawalByIdTask',
            [$this->id]
        )->user_id == $this->user()->id);
    }
}
