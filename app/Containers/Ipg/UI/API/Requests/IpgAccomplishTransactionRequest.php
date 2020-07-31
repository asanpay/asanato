<?php

namespace App\Containers\Ipg\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Tartan\Log\Facades\XLog;

/**
 * Class IpgVerifyTransactionRequest.
 */
class IpgAccomplishTransactionRequest extends Request
{
    protected $access = [];
    /**
     * @return  array
     */
    public function rules()
    {
        XLog::debug('IpgRequestTokenRequest', $this->all());
        return [];
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
