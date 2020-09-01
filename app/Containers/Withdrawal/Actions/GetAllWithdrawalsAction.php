<?php

namespace App\Containers\Withdrawal\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllWithdrawalsAction extends Action
{
    public function run(Request $request)
    {
        $withdrawals = Apiato::call('Withdrawal@GetAllWithdrawalsTask', [], ['addRequestCriteria']);

        return $withdrawals;
    }
}
