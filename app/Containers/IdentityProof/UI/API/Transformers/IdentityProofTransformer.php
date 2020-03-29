<?php

namespace App\Containers\IdentityProof\UI\API\Transformers;

use App\Containers\IdentityProof\Enum\IdPoofType;
use App\Containers\IdentityProof\Models\IdentityProof;
use App\Ship\Parents\Transformers\Transformer;
use App\Ship\Transformers\MediaTransformer;

class IdentityProofTransformer extends Transformer
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
        'media'
    ];

    /**
     * @param IdentityProof $entity
     *
     * @return array
     */
    public function transform(IdentityProof $entity)
    {
        $response = [
            'type' => $entity->proof_type,
            'readable_type' => IdPoofType::getLabel($entity->proof_type),
            'id' => $entity->getHashedKey(),
            'reject_reason' => $entity->reject_reason,
            'created_at' => $entity->created_at,
            'readable_created_at'  => $entity->created_at->diffForHumans(),
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
        ], $response);

        return $response;
    }

    public function includeMedia(IdentityProof $entity)
    {
        return $this->collection($entity->getMedia('user_idproof_'.$entity->proof_type), new MediaTransformer(), 'media');
    }
}
