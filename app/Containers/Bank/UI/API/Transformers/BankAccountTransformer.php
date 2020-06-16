<?php

namespace App\Containers\Bank\UI\API\Transformers;

use App\Containers\Bank\Models\BankAccount;
use App\Ship\Parents\Transformers\Transformer;

class BankAccountTransformer extends Transformer
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
     * @param BankAccount $entity
     *
     * @return array
     */
    public function transform(BankAccount $entity)
    {
        $response = [
            'object' => 'BankAccount',
            'id' => $entity->getHashedKey(),
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,

        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
