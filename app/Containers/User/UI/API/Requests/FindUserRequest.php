<?php

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class FindUserRequest.
 */
class FindUserRequest extends Request
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'keyword' => 'required|string|min:3',
        ];
    }
}
