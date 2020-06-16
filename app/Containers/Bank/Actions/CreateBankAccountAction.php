<?php

namespace App\Containers\Bank\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateBankAccountAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'iban',
        ]);

        $data['ip_address'] = $request->getClientIp();
        $data['user_id'] = $request->user()->id;

        $bank = Apiato::call('Bank@CreateBankAccountTask', [$data]);

        return $bank;
    }
}
