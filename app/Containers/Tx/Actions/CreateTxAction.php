<?php

namespace App\Containers\Tx\Actions;

use App\Containers\Tx\Models\Tx;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateTxAction extends Action
{
    public function run(array $data): Tx
    {
        $tx = Apiato::call('Tx@CreateTxTask', [$data]);

        return $tx;
    }
}
