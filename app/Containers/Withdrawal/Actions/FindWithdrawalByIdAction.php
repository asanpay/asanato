<?php

namespace App\Containers\Withdrawal\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindWithdrawalByIdAction extends Action
{
    public function run(Request $request)
    {
        $withdrawal = Apiato::call('Withdrawal@FindWithdrawalByIdTask', [$request->id]);

        return $withdrawal;
    }
}
