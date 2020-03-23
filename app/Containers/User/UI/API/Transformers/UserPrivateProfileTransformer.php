<?php

namespace App\Containers\User\UI\API\Transformers;

use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\Models\User;
use App\Ship\Parents\Transformers\Transformer;

/**
 * Class UserPrivateProfileTransformer.
 *
 * @author Johannes Schobel <johannes.schobel@googlemail.com>
 */
class UserPrivateProfileTransformer extends Transformer
{

    /**
     * @var  array
     */
    protected $availableIncludes = [
        'roles',
    ];

    /**
     * @var  array
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
            'object'       => 'User',
            'id'           => $user->getHashedKey(),
            'type'         => $user->type,
            'gender'       => $user->gender,
            'first_name'   => $user->first_name,
            'last_name'    => $user->last_name,
            'tel'          => $user->tel,
            'mobile'       => $user->mobile,
            'email'        => $user->email,
            'address'      => $user->address,
            'zip'          => $user->zip,
            'avatar'       => $user->getAvatar(256),
            'national_id'  => $user->national_id,
            'company'      => $user->company,
            'financial_is' => $user->financial_id,
            'group'        => $user->group,
            'idproofs'     => $user->idproofs,
            'locked'       => $user->locked,
            'lock_reason'  => $user->lock_reason,
            'meta'         => json_decode($user->meta, JSON_UNESCAPED_UNICODE),

            'birth_date'          => $user->birth_date,
            'created_at'          => $user->created_at,
            'updated_at'          => $user->updated_at,
            'j_birth_date'        => $user->j_birth_date,
            'j_created_at'        => $user->j_created_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),
        ];

        $response = $this->ifAdmin([
            'real_id'    => $user->id,
            'deleted_at' => $user->deleted_at,
        ], $response);

        return $response;
    }

    public function includeRoles(User $user)
    {
        return $this->collection($user->roles, new RoleTransformer());
    }

}
