<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\Model as AbstractModel;
use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Carbon\Carbon;

/**
 * Class Model.
 */
abstract class Model extends AbstractModel
{

    use HashIdTrait;
    use HasResourceKeyTrait;

    public function getCreatedAtAttribute()
    {
        return @Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        return @Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
    }

    public function getDeletedAtAttribute()
    {
        return @Carbon::parse($this->attributes['deleted_at'])->format('Y-m-d H:i:s');
    }
}
