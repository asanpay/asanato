<?php

namespace App\Containers\Bank\Models;

use App\Ship\Parents\Models\Model;

class Gateway extends Model
{
    protected $table = 'gateways';

    protected $guarded = [];

    public function psp()
    {
        return $this->belongsTo(Psp::class, 'psp_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * @param array $patches
     *
     * @return array
     */
    public function getRealtimeProperties(array $patches = []): array
    {
        return array_merge(json_decode($this->properties, true), $patches);
    }
}
