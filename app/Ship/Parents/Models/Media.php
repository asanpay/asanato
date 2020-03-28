<?php


namespace App\Ship\Parents\Models;

use Apiato\Core\Traits\HasResourceKeyTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasResourceKeyTrait;

    protected $resourceKey = 'media';
}
