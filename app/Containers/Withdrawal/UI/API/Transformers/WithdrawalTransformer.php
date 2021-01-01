<?php

namespace App\Containers\Withdrawal\UI\API\Transformers;

use App\Containers\Withdrawal\Models\Withdrawal;
use App\Ship\Parents\Transformers\Transformer;
use Vinkla\Hashids\Facades\Hashids;

class WithdrawalTransformer extends Transformer
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
     * @param Withdrawal $entity
     *
     * @return array
     */
    public function transform(Withdrawal $entity)
    {
        $response = [
            'object'          => 'Withdrawal',
            'id'              => $entity->getHashedKey(),
            'wallet_id'       => Hashids::encode($entity->wallet_id),
            'bank_account_id' => Hashids::encode($entity->bank_account_id),
            'sheba'           => $entity->bankAccount->sheba,
            'status'          => $entity->status,
            'created_at'      => $entity->created_at,
            'processed_at'    => $entity->processed_at,
            'updated_at'      => $entity->updated_at,
            'deleted_at'      => $entity->deleted_at,

        ];

        $response = $this->ifAdmin(
            [
                'real_id' => $entity->id,
            ],
            $response
        );

        return $response;
    }
}
