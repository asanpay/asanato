<?php


namespace App\Containers\Withdrawal\Observers;


use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Withdrawal\Enum\WithdrawalStatus;
use App\Containers\Withdrawal\Models\Withdrawal;
use App\Ship\Traits\Jalali;

class WithdrawalObserver
{
    use Jalali;

    public function creating(Withdrawal $w)
    {
        // before create ::
        if (empty($w->j_created_at)) {
            $w->j_created_at =  static::jalaliTimestamp();
        }
    }

    public function updating(Withdrawal $w)
    {
        // before updating
        if ($w->originalIsEquivalent('status') != true && $w->status == WithdrawalStatus::DONE) {
             // create FEE tx after successful transfer
            Apiato::call('Tx@CreateProfitTxFromWithdrawSubAction', [$w]);

            // create outgoing wallet tx after successful transfer
            Apiato::call('Tx@CreateOutgoingTxFromWithdrawSubAction', [$w]);
        }
    }
}
