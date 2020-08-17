<?php

namespace App\Containers\Ipg\Tasks;

use App\Containers\Ipg\Enum\MultiplexType;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\Wallet\Traits\InvolvedWalletsFixMethod;
use App\Containers\Wallet\Traits\InvolvedWalletsPercentageMethod;
use App\Ship\Parents\Tasks\Task;

class GetInvolvedWalletSharesTask extends Task
{
    use InvolvedWalletsFixMethod;
    use InvolvedWalletsPercentageMethod;

    public function run(Transaction $t): array
    {
        if (!empty($t->multiplex) && isset($t->multiplex['wallets']) && !empty($t->multiplex['wallets'])) {
            // transaction has multiplex data
            return $this->getInvolvedWalletsShareFromMultiplex($t);
        }

        return $this->getInvolvedWalletsShareFromMerchantPivot($t);
    }

    private function getInvolvedWalletsShareFromMerchantPivot(Transaction $t): array
    {
        echo 'GetInvolvedWalletsShareFromMerchantPivot' . PHP_EOL;
        $merchantWallets = $t->merchant->wallets->toArray();
        echo sprintf('transaction id %d has %d involved wallets', $t->id, count($merchantWallets)) . PHP_EOL;

        $overflowShare   = 0;
        $involvedWallets = [];
        $maxShare        = 0;
        $maxShareIndex   = 0;

        foreach ($merchantWallets as $i => $w) {
            $walletShare      = $w['pivot']['share'];
            $walletMoneyShare = ($walletShare / 100) * $t->merchant_share;

            $overflow = $walletMoneyShare - intval($walletMoneyShare);
            if ($walletShare > $maxShare) {
                $maxShare      = $walletShare;
                $maxShareIndex = $i;
            }

            $involvedWallets [$i] = [
                'id'          => $w['id'],
                'owner'       => $w['user_id'],
                'share'       => $walletShare,
                'money_share' => currency($walletMoneyShare),
                'extra_share' => $overflow,
            ];

            $overflowShare += $overflow;
        }

        if ($overflowShare > 0) {
            // add extra share to the wallet that has biggest share
            $involvedWallets[$maxShareIndex]['transaction_share'] += intval(round($overflowShare));
        }

        return $involvedWallets;
    }

    private function getInvolvedWalletsShareFromMultiplex(Transaction $t): array
    {
        echo 'GetInvolvedWalletsShareFromMultiplex' . PHP_EOL;
        echo sprintf('transaction id %d has %d involved wallets', $t->id, count($t->multiplex['wallets'])) . PHP_EOL;

        if ($t->multiplex['method'] == MultiplexType::PERCENT) {
            if (isset($t->multiplex['feePayerWallet'])) {
                return $this->calculateInvolvedWalletsShareByPercentageMethodOneFeePayer($t);
            }

            return $this->calculateInvolvedWalletsShareByPercentageMethodAllFeePayer($t);
        } else { // fix fee policy
            if (isset($t->multiplex['feePayerWallet'])) {
                return $this->calculateInvolvedWalletsShareByFixMethodOneFeePayer($t);
            }

            return $this->calculateInvolvedWalletsShareByFixMethodAllFeePayer($t);
        }
    }
}
