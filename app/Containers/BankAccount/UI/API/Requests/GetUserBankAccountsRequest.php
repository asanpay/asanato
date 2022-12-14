<?php

namespace App\Containers\BankAccount\UI\API\Requests;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\App;

/**
 * Class GetUserBankAccountsRequest
 */
class GetUserBankAccountsRequest extends Request
{
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
        'user_id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var array
     */
    protected $urlParameters = [
        'user_id',
    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|numeric|exists:users,id'
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
        return App::make(GetAuthenticatedUserTask::class)->run()->id == $this->user_id;
    }
}
