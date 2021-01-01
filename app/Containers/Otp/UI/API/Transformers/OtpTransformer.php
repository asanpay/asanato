<?php

namespace App\Containers\Otp\UI\API\Transformers;

use App\Containers\Otp\Models\Otp;
use App\Ship\Parents\Transformers\Transformer;

class OtpTransformer extends Transformer
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
     * @param Otp $entity
     *
     * @return array
     */
    public function transform(Otp $entity)
    {
        $response = [
            'object' => 'Otp',
            'id' => $entity->getHashedKey(),
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,

        ];

        $response = $this->ifAdmin(
            [
                'real_id'    => $entity->id,
                // 'deleted_at' => $entity->deleted_at,
            ],
            $response
        );

        return $response;
    }
}
