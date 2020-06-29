<?php

namespace App\Containers\Bank\Tasks;

use App\Containers\Bank\Data\Repositories\GatewayRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;
use Exception;
use Illuminate\Support\Facades\DB;

class GetAvailableGatewaysTask extends Task
{
    protected $repository;

    public function __construct(GatewayRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(
        bool $direct = true,
        bool $refundSupport = null,
        bool $active = true,
        array $patches = []
    ): Collection {
        try {

            // @todo cache the result
            $gates = DB::table('gateways as g')
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

            $gates = $gates->map(function ($item) use ($patches) {
                $item->properties = array_merge($patches, json_decode($item->properties, true));

                return $item;
            });

            return $gates;

        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
