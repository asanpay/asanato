<?php

namespace App\Containers\Transaction\UI\API\Transformers;

use App\Containers\Transaction\Models\Transaction;
use App\Ship\Parents\Transformers\Transformer;

class TransactionTransformer extends Transformer
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
     * @param Transaction $entity
     *
     * @return array
     */
    public function transform(Transaction $entity)
    {
        $response = [
            'object' => 'Transaction',
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
