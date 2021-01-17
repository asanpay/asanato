<?php

namespace App\Containers\Transfer\Actions;

use App\Containers\Transfer\Traits\TransferToOthersWalletTrait;
use App\Containers\Tx\Models\Tx;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class TransferToOtherUserAction extends Action
{
    use TransferToOthersWalletTrait;

    public function run(Request $request): Tx
    {
        $data = $request->sanitizeInput(
            [
                'src_wallet_id',
                'dst_user_id',
                'amount',
                'description',
                'client_ip',
                'token',
            ]
        );

        // find destination wallet based on destination user
        $dstWallet = Apiato::call(
            'Wallet@FindUserDefaultWalletTask',
            [$data['dst_user_id']]
        );

        return $this->transfer(
            $request->user(),
            $data['src_wallet_id'],
            $dstWallet->id,
            $data['amount'],
            $data['description'],
            $request->getClientIp(),
            $data['token'],
        );
    }
}
