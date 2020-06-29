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
            'bank_id',
            'default',
        ]);
        $data['ip_address'] = $request->getClientIp();

        if ($request->user()->can('create-bank-accounts') && $request->has('user_id')) {
            // request user can create wallet for any user
            $data['user_id'] = $request->user_id;
        } else {
            // request user can create wallet only for himself
            $data['user_id'] = $request->user()->id;
        }

        if (Apiato::call('BankAccount@GetBankAccountsTask', [], [
            'addRequestCriteria',
            [
                'pushCurrentUserCriteria' => [Apiato::call('User@FindUserByIdTask', [$data['user_id']])],
            ],
        ])->count() == 0) {
            // This is the first user's bank account
            $data['default'] = true;
        }

        return Apiato::call('BankAccount@CreateBankAccountTask', [$data]);
    }
}
