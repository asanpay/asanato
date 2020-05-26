<?php

namespace App\Containers\Wallet\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Facades\DB;

class UpdateWalletAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name',
            'default'
        ]);

        DB::transaction(function () use($request, $data, &$wallet){
        // remove default flag from all other user wallets
            if (boolval($request->default) === true) {
                DB::update('update wallets set "default" = false where user_id = ?', [$request->user()->id]);
            }

            $wallet = Apiato::call('Wallet@UpdateWalletTask', [$request->id, $data]);
        });

        return $wallet;
    }
}
