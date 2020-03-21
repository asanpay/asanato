<?php

namespace App\Containers\Helpdesk\UI\API\Transformers;

use App\Containers\Helpdesk\Models\Helpdesk;
use App\Ship\Parents\Transformers\Transformer;

class HelpdeskTransformer extends Transformer
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
     * @param Helpdesk $entity
     *
     * @return array
     */
    public function transform(Helpdesk $entity)
    {
        $response = [
            'object' => 'Helpdesk',
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
