<?php

namespace App\Containers\Bank\Models;

use App\Ship\Parents\Models\Model;


class Psp extends Model
{

    protected $table = 'psps';

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'psps';

    /**
     * return all Psps except me (Asanpay)
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeOthers($query)
    {
        return $query->where('slug', '<>', 'asanpay');
    }

    /**
     * return only active Psps
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
