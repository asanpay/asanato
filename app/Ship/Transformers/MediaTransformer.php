<?php


namespace App\Ship\Transformers;

use Apiato\Core\Traits\HashIdTrait;
use App\Ship\Parents\Transformers\Transformer;
use Illuminate\Support\Facades\Config;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaTransformer extends Transformer
{
    use HashIdTrait;

    public function transform(Media $entity)
    {
        $response = [
            'id' => $this->encode($entity->id),
            'url' => $entity->getUrl(),
            'created_at' => $entity->created_at,
            'readable_created_at'  => $entity->created_at->diffForHumans(),
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
        ], $response);

        return $response;
    }
}
