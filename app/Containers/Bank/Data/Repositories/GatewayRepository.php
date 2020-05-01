<?php

namespace App\Containers\Bank\Data\Repositories;

use App\Containers\Bank\Models\Gateway;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Ship\Parents\Repositories\Repository;

class GatewayRepository extends Repository
{
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Gateway::class;
    }

    /**
     * @param bool $direct
     * @param bool|null $refundSupport
     * @param bool $active
     * @param array $patches
     *
     * @return Collection
     */
    public function getFunctionalGateways(
        bool $direct = true,
        bool $refundSupport = null,
        bool $active = true,
        array $patches = []
    ): Collection {
        // @todo cache the result
        $gates = DB::table($this->getTableName() . ' as g')
            ->select(['g.id', 'g.properties', 'g.psp_id', 'psps.slug as psp'])
            ->join('psps', function ($join) use ($direct, $refundSupport) {
                $join->on('g.psp_id', '=', 'psps.id');

                // include /exclude app gateway
                if ($direct == true) {
                    $join->where('psps.app_gate', false);
                } else {
                    $join->where('psps.app_gate', true);
                }
                // only gateways that support refund
                if ($refundSupport == true) {
                    $join->where('psps.refund_support', true);
                }
            });

        // only active gateways
        if ($active === true) {
            $gates = $gates->where('g.status', true);
        }

        $gates = $gates->get();

        $gates = $gates->map(function ($item) use($patches){
            $item->properties = array_merge($patches, json_decode($item->properties, true));

            return $item;
        });

        return  $gates;
    }
}
