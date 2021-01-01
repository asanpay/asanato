<?php

namespace App\Containers\Wallet\Traits;

use App\Containers\Transaction\Models\Transaction;
use Apiato\Core\Foundation\Facades\Apiato;

trait InvolvedWalletsPercentageMethod
{
    private function calculateInvolvedWalletsShareByPercentageMethodAllFeePayer(Transaction $t): array
    {
        $overflowShare = 0;
        $maxShare        = 0;
        $maxShareIndex   = 0;


        foreach ($t->multiplex['wallets'] as $i => $w) {
            $walletShare = $t->multiplex['shares'][$i];

            // find wallet index with max share
            if ($walletShare > $maxShare) {
                $maxShare      = $walletShare;
                $maxShareIndex = $i;
            }

            // user merchant share after reducing the transaction fee
            $walletMoneyShare = ($walletShare / 100) * $t->merchant_share;
            $overflow         = $walletMoneyShare - intval($walletMoneyShare);

            $involvedWallets [$i] = [
                'id'          => $w,
                'owner'       => Apiato::call('wallet@FindWalletByIdTask', [$w])->user_id,
                'share'       => $walletShare,
                'money_share' => currency($walletMoneyShare),
                'extra_share' => $overflow,
            ];

            $overflowShare += $overflow;
        }

        if ($overflowShare > 0) {
            $involvedWallets [$maxShareIndex] ['money_share'] =
                currency($involvedWallets [$maxShareIndex] ['money_share'] + $overflowShare);
        }

        return $involvedWallets;
    }

    private function calculateInvolvedWalletsShareByPercentageMethodOneFeePayer(Transaction $t): array
    {
        $systemFee     = $t->getMerchantFee();
        $overflowShare = 0;

        foreach ($t->multiplex['wallets'] as $i => $w) {
            $walletShare      = $t->multiplex['shares'][$i];

            // using transaction amount because we will reduce system fee from wallet share
            $walletMoneyShare = ($walletShare / 100) * $t->amount;

            // find index of the wallet that is responsible for paying transaction fee
            if ($t->multiplex['feePayerWallet'] == $w) {
                $feePayerWalletIndex = $i;
                $walletMoneyShare    -= $systemFee;
            }
            $overflow = $walletMoneyShare - intval($walletMoneyShare);

            $involvedWallets [$i] = [
                'id'          => $w,
                'owner'       => Apiato::call('wallet@FindWalletByIdTask', [$w])->user_id,
                'share'       => $walletShare,
                'money_share' => currency($walletMoneyShare),
                'extra_share' => $overflow,
            ];

            $overflowShare += $overflow;
        }

        if ($overflowShare > 0) {
            $involvedWallets [$feePayerWalletIndex] ['money_share'] =
                currency($involvedWallets [$feePayerWalletIndex] ['money_share'] + $overflowShare);
        }

        return $involvedWallets;
    }
}
