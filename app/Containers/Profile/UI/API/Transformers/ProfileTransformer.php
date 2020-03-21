<?php

namespace App\Containers\Profile\UI\API\Transformers;

use App\Containers\Profile\Models\Profile;
use App\Ship\Parents\Transformers\Transformer;

class ProfileTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param Profile $entity
     *
     * @return array
     */
    public function transform(Profile $entity)
    {
        $response = [
            'object' => 'Profile',
            'id' => $entity->getHashedKey(),
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,

        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            // 'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
