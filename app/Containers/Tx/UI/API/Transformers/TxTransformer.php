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
        $meta = $entity->meta;

        $response = [
            'object'         => 'Tx',
            'id'             => $entity->getHashedKey(),
            'client_ip'      => $meta->ip ?? 'unknown',
            'j_created_at'   => $entity->j_created_at,
            'created_at'     => $entity->created_at,
            'tracking_id'    => $entity->tracking_id,
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id
        ], $response);

        return $response;
    }
}
