<?php

namespace App\Containers\Wallet\UI\API\Transformers;

use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Transformers\Transformer;
use Tartan\Zaman\Facades\Zaman;

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
            'object'         => 'Wallet',
            'id'             => $entity->getHashedKey(),
            'name'           => $entity->name,
            'raw_balance'    => $entity->balance,
            'locked_balance' => $entity->locked_balance,
            'balance'        => $entity->getBalance(),
            'transfer_limit' => $entity->transfer_limit,
            'default'        => $entity->default,
//            'rel_created_at' => persian(Zaman::moment(strtotime($entity->created_at))),
            'j_created_at'   => Zaman::gToj($entity->created_at),
            'created_at'     => $entity->created_at,
            'updated_at'     => $entity->updated_at,
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
