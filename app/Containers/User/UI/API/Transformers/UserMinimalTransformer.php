<?php

namespace App\Containers\User\UI\API\Transformers;

use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\Models\User;
use App\Ship\Parents\Transformers\Transformer;

/**
 * Class UserMinimalTransformer.
 */
class UserMinimalTransformer extends Transformer
{

    /**
     * @var array
     */
    protected $availableIncludes = [
        'roles',
    ];

    /**
     * @var array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        $response = [
            'object' => 'User',
            'id'     => $user->getHashedKey(),
            'name'   => $user->full_name,
            'avatar' => $user->getAvatar(128),
        ];

        if (preg_match(config('regex.mobile_regex'), request()->keyword)) {
            $response ['mobile'] =  $user->mobile;
        } else {
            $response ['email'] =  $user->email;
        }
        return $response;
    }
}
