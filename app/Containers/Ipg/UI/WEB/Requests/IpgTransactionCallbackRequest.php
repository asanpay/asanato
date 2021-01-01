<?php

namespace App\Containers\Ipg\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use Tartan\Log\Facades\XLog;

class IpgTransactionCallbackRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var array
     */
    protected $access = [
        'permissions' => null
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var array
     */
    protected $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var array
     */
    protected $urlParameters = [

    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        XLog::info('IpgTransactionCallbackRequest::rules', $this->all());

        return [];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
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
