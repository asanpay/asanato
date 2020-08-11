<?php


namespace App\Containers\Wallet\Traits;


use App\Containers\Transaction\Models\Transaction;

trait InvolvedWalletsFixMethod
{

    private function calculateInvolvedWalletsShareByFixMethodAllFeePayer(Transaction $t): array
    {

        $overflowShare = 0;
        $maxShare        = 0;
        $maxShareIndex   = 0;
        $systemFee     = $t->getMerchantFee();

        foreach ($t->multiplex['wallets'] as $i => $w) {
            $walletShare = $t->multiplex['shares'][$i]; // in currency. eg: rial

            // find wallet index with max share
            if ($walletShare > $maxShare) {
                $maxShare      = $walletShare;
                $maxShareIndex = $i;
            }

            // wallet's share percentage
            $walletShareInPercent = round(($t->multiplex['shares'][$i] / $t->amount) * 100, 2);
            $walletFeeShare       = $systemFee * $walletShareInPercent; // in currency

            $walletMoneyShare = $walletShare - $walletFeeShare;
            $overflow         = $walletMoneyShare - intval($walletMoneyShare);

            $involvedWallets [] = [
                'id'          => $w,
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

    private function calculateInvolvedWalletsShareByFixMethodOneFeePayer(Transaction $t): array
    {
        $systemFee = $t->getMerchantFee();

        foreach ($t->multiplex['wallets'] as $i => $w) {
            $walletShare = $t->multiplex['shares'][$i];

            if ($t->multiplex['feePayerWallet'] == $w) {
                $moneyShare = $walletShare - $systemFee;
            } else {
                $moneyShare = $walletShare;
            }

            $involvedWallets [] = [
                'id'          => $w,
                'share'       => $walletShare,
                'money_share' => intval($moneyShare),
                'extra_share' => 0,
            ];
        }

        return $involvedWallets;
    }
}
