<?php

namespace App\Containers\Merchant\UI\API\Transformers;

use App\Containers\Merchant\Models\Merchant;
use App\Ship\Parents\Transformers\Transformer;

class MerchantTransformer extends Transformer
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
     * @param Merchant $entity
     *
     * @return array
     */
    public function transform(Merchant $entity)
    {
        $response = [
            'object' => 'Merchant',
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
