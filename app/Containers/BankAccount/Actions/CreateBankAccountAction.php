<?php

namespace App\Containers\BankAccount\Actions;

use App\Containers\BankAccount\Models\BankAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateBankAccountAction extends Action
{
    public function run(Request $request): BankAccount
    {
        $data = $request->sanitizeInput([
            'iban',
            'default',
        ]);

        $data['ip_address'] = $request->getClientIp();
        $data['user_id']    = $request->user()->id;

        return Apiato::call('BankAccount@CreateBankAccountTask', [$data]);
    }
}
