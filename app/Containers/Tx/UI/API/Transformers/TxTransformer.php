<?php

namespace App\Containers\Tx\UI\API\Transformers;

use App\Containers\Tx\Models\Tx;
use App\Ship\Parents\Transformers\Transformer;

class TxTransformer extends Transformer
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
     * @param Tx $entity
     *
     * @return array
     */
    public function transform(Tx $entity)
    {
        $response = [
            'object' => 'Tx',
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
