<?php

namespace App\Containers\IdentityProof\UI\API\Transformers;

use App\Containers\IdentityProof\Models\IdentityProof;
use App\Ship\Parents\Transformers\Transformer;

class IdentityProofTransformer extends Transformer
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
     * @param IdentityProof $entity
     *
     * @return array
     */
    public function transform(IdentityProof $entity)
    {
        $response = [
            'object' => 'IdentityProof',
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
