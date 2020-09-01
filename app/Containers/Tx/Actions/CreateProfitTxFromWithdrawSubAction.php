<?php

namespace App\Containers\Tx\Actions;

use App\Containers\Tx\Enum\TxType;
use App\Containers\Wallet\Enum\WalletType;
use App\Containers\Wallet\Models\Wallet;
use App\Containers\Withdrawal\Models\Withdrawal;
use App\Ship\Parents\Actions\SubAction;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Facades\Config;
use Tartan\Log\Facades\XLog;

class CreateProfitTxFromWithdrawSubAction extends SubAction
{
    protected Wallet $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function run(Withdrawal $withdrawal): void
    {
        XLog::debug('withdraw profit tx', [$withdrawal->tagify()]);

        $profitWallet = Apiato::call('Wallet@GetSystemWalletTask', [WalletType::PROFIT]);
        $fee          = Config::get('withdrawal-container.fee');

        $data = [
            'type'          => TxType::PROFIT,
            'wallet_id'     => $profitWallet->id,
            'user_id'       => $withdrawal->user_id,
            'withdrawal_id' => $withdrawal->id,
            'creditor'      => $fee,
            'ip'            => $withdrawal->ip,
            'meta'          => [
                'description' => trans('withdraw::withdraw.withdraw_fee', ['id' => $withdrawal->id]),
            ],
        ];

        Apiato::call('Tx@CreateTxTask', [$data]);
    }
}
