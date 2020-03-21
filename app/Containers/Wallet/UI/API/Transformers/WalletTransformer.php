<?php

namespace App\Containers\Wallet\UI\API\Transformers;

use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Transformers\Transformer;

class WalletTransformer extends Transformer
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
            'object' => 'Wallet',
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
