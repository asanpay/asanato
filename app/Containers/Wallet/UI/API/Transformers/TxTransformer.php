<?php

namespace App\Containers\Wallet\UI\API\Transformers;

use App\Containers\Wallet\Models\Wallet;
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
    public function transform(Wallet $entity)
    {
        $response = [
            'object'         => 'Tx',
            'id'             => $entity->getHashedKey(),
            'j_created_at'   => Zaman::gToj($entity->created_at),
            'created_at'     => $entity->created_at,
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id
        ], $response);

        return $response;
    }
}
