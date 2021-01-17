<?php

namespace App\Containers\Transfer\Actions;

use App\Containers\Transfer\Traits\TransferToOthersWalletTrait;
use App\Containers\Tx\Models\Tx;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class TransferToOthersWalletsAction extends Action
{
    use TransferToOthersWalletTrait;

    public function run(Request $request): Tx
    {
        $data = $request->sanitizeInput(
            [
                'src_wallet_id',
                'dst_wallet_id',
                'amount',
                'description',
                'client_ip',
                'token',
            ]
        );

        return $this->transfer(
            $request->user(),
            $data['src_wallet_id'],
            $data['dst_wallet_id'],
            $data['amount'],
            $data['description'],
            $request->getClientIp(),
            $data['token'],
        );
    }
}
