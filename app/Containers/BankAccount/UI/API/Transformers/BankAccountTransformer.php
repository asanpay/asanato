<?php

namespace App\Containers\BankAccount\UI\API\Transformers;

use App\Containers\BankAccount\Models\BankAccount;
use App\Ship\Parents\Transformers\Transformer;

class BankAccountTransformer extends Transformer
{
    /**
     * @var array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var array
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
        $entity->refresh();
        $response = [
            'object' => 'BankAccount',
            'id' => $entity->getHashedKey(),
            'user_id' => $entity->user->getHashedKey(),
            'iban' => $entity->iban,
            'sheba' => $entity->sheba,
            'status' => $entity->status,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,

        ];

        $response = $this->ifAdmin(
            [
                'real_id'    => $entity->id,
                'deleted_at' => $entity->deleted_at,
            ],
            $response
        );

        return $response;
    }
}
