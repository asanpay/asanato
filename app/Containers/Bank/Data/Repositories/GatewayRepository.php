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
    public function model()
    {
        return Gateway::class;
    }
}
