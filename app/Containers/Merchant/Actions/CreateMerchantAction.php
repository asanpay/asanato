<?php

namespace App\Containers\Merchant\Actions;

use App\Containers\Merchant\Exceptions\CouldNotCreateMerchantException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateMerchantAction extends Action
{
    public function run(Request $request)
    {
        $this->validateRequestData($request);

        $data     = $request->sanitizeInput([
            'name',
            'domain',
            'ip_access',
            'multiplex_support',
            'sharing',
        ]);
        $merchant = Apiato::call('Merchant@CreateMerchantTask', [$data]);

        collect($data['sharing'])->each(function ($item, $key) use ($merchant) {
            $merchant->wallets()->attach($item['wallet'], ['share' => $item['share']]);
        });

        return $merchant;
    }

    private function validateRequestData(Request $request)
    {
        $data = $request->all();

        if ($data['multiplex_support'] == false && count($data['sharing']) != 1) {
            throw new CouldNotCreateMerchantException(trans('merchant without multiplex support could have just one sharing wallet with 100 percent share'));
        }

        if ($data['multiplex_support'] == true && count($data['sharing']) < 1) {
            throw (new CouldNotCreateMerchantException(trans('merchant with multiplex support should have at least one sharing wallet')));
        }

        $wallets    = [];
        $totalShare = 0;

        foreach ($data['sharing'] as $d) {
            $wallets [] = $d['wallet'];
            $totalShare += $d['share'];
        }

        if ($totalShare != 100) {
            throw (new CouldNotCreateMerchantException(trans('the sum of shares is not equal to 100')));
        }

        // check user access to all requested wallets
        $userHasAccess = Apiato::call('User@CheckUserHasAccessToWalletsTask',
            [$request->user()->id, $wallets]);

        if ($userHasAccess !== true) {
            throw (new CouldNotCreateMerchantException(trans('you dont have access to all passed sharing wallets')));
        }
    }
}
