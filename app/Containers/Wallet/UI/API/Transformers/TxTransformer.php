<?php

namespace App\Containers\Wallet\UI\API\Transformers;

use App\Containers\Wallet\Models\Tx;
use App\Ship\Parents\Transformers\Transformer;
use Tartan\Zaman\Facades\Zaman;

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
     * @param Wallet $entity
     *
     * @return array
     */
    public function transform(Tx $entity)
    {
        $meta = json_decode($entity->meta);

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
