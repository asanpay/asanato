<?php

namespace App\Containers\Bank\UI\API\Transformers;

use App\Containers\Bank\Models\Bank;
use App\Ship\Parents\Transformers\Transformer;

class BankTransformer extends Transformer
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
     * @param Bank $entity
     *
     * @return array
     */
    public function transform(Bank $entity)
    {
        $response = [
            'object' => 'Bank',
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
