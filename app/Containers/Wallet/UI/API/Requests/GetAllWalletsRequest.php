<?php

namespace App\Containers\Wallet\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class GetAllWalletsRequest.
 */
class GetAllWalletsRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Wallet\Data\Transporters\GetAllWalletsTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var array
     */
    protected $access = [
        'permissions' => 'read-wallets',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var array
     */
    protected $decode = [
    //         'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var array
     */
    protected $urlParameters = [
    //         'id',
    ];

    /**
     * @return array
     */
    public function rules()
    {
        return [
        //             'id' => 'required',
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
