<?php

namespace App\Containers\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class SetUserGoogleAuthRequest.
 */
class SetUserGoogleAuthRequest extends Request
{
    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'token' => 'required|numeric|min:100000'
        ];
    }
}
