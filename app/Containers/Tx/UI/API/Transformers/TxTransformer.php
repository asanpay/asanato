<?php

namespace App\Containers\Tx\UI\API\Transformers;

use App\Containers\Tx\Models\Tx;
use App\Containers\Wallet\UI\API\Transformers\WalletTransformer;
use App\Ship\Parents\Transformers\Transformer;

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
        'wallet'
    ];

    /**
     * @param Tx $entity
     *
     * @return array
     */
    public function transform(Tx $entity)
    {
        $meta = $entity->meta;

        $response = [
            'object'         => 'Tx',
            'id'             => $entity->getHashedKey(),
            'wallet_id'      => $entity->wallet_id,
            'type'           => $entity->type,
            'transaction_id' => $entity->transaction_id,
            'raw_amount'     => $entity->raw_amount,
            'user_share'     => $entity->user_share,
            'creditor'       => $entity->creditor,
            'debtor'         => $entity->debtor,
            'profit'         => $entity->profit,
            'balance'        => $entity->balance,
            'client_ip'      => $entity->ip_address ?? 'unknown',
            'j_created_at'   => $entity->j_created_at,
            'created_at'     => $entity->created_at,
            'tracking_id'    => $entity->tracking_id,
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
    }

    public function includeWallet(Tx $tx)
    {
        // use `item` with single relationship
        return $this->item($tx->wallet, new WalletTransformer());
    }
}
