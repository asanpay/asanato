<?php

namespace App\Containers\User\UI\API\Transformers;

use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\Models\User;
use App\Ship\Parents\Transformers\Transformer;

/**
 * Class UserPrivateProfileTransformer.
 */
class UserQrCodeTransformer extends Transformer
{
    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        $response = [
            'object'       => 'User',
            'id'           => $user->getHashedKey(),
            'qr_code'      => $user->getInlineQrCode(),
        ];

        $response = $this->ifAdmin(
            [
                'real_id'    => $user->id,
                'deleted_at' => $user->deleted_at,
            ],
            $response
        );

        return $response;
    }
}
