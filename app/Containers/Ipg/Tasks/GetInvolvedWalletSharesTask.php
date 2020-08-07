<?php

namespace App\Containers\Ipg\Tasks;

use App\Containers\Ipg\Enum\MultiplexType;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Parents\Tasks\Task;

class GetInvolvedWalletSharesTask extends Task
{

    public function run(Transaction $t) : array
    {
        if (!empty($t->multiplex) && isset($t->multiplex['wallets']) && !empty($t->multiplex['wallets'])) {
            // transaction has multiplex data
            return $this->getInvolvedWalletsShareFromMultiplex($t);
        }

        return $this->getInvolvedWalletsShareFromMerchantPivot($t);
    }

    private function getInvolvedWalletsShareFromMerchantPivot(Transaction $t): array
    {
        $this->info('GetInvolvedWalletsShareFromMerchantPivot');
        $merchantWallets = $t->merchant->wallets->toArray();

        $this->info(sprintf('transaction id %d has %d involved wallets', $t->id, count($merchantWallets)));

        $overflowShare   = 0;
        $involvedWallets = [];


        foreach ($merchantWallets as $w) {
            $thisWalletShare = $w['pivot']['share'];
            $moneyShare      = $thisWalletShare * $t->merchant_share / 100;


            $involvedWallets [] = [
                'id'                => $w['id'],
                'share'             => $thisWalletShare,
                'transaction_share' => intval($moneyShare),
                'extra_share'       => $moneyShare - intval($moneyShare),
            ];
            $overflowShare      += $moneyShare - intval($moneyShare);
        }

        if ($overflowShare > 0) {
            // add extra share to the wallet that has biggest share
            $involvedWallets[0]['transaction_share'] += intval(round($overflowShare));
        }

        return $involvedWallets;
    }

    private function getInvolvedWalletsShareFromMultiplex(Transaction $t): array
    {
        $this->info('GetInvolvedWalletsShareFromMultiplex');
        $multiplexWallets = $t->multiplex['wallets'];
        $this->info(sprintf('transaction id %d has %d involved wallets', $t->id, count($multiplexWallets)));

        $multiplexMethod = $t->multiplex['method'];

        $overflowShare = 0;

        if ($t->multiplex['method'] == MultiplexType::PERCENT) {
            foreach ($multiplexWallets as $w) {
                $thisWalletShare = $w['share'];
                $moneyShare      = $thisWalletShare * $t->merchant_share / 100;

                $involvedWallets [] = [
                    'id'                => $w['id'],
                    'share'             => $thisWalletShare,
                    'transaction_share' => intval($moneyShare),
                    'extra_share'       => $moneyShare - intval($moneyShare),
                ];

                $overflowShare += $moneyShare - intval($moneyShare);
            }
        } else {
            $merchantFee = $t->getMerchantFee();

            foreach ($multiplexWallets as $w) {
                $thisWalletShare = $w['share'];
                if (isset($w['fee'])) {
                    $moneyShare = $w['share'] - $merchantFee;
                } else {
                    $moneyShare = $w['share'];
                }

                $involvedWallets [] = [
                    'id'                => $w['id'],
                    'share'             => $thisWalletShare,
                    'transaction_share' => intval($moneyShare),
                    'extra_share'       => 0,
                ];
            }
        }

        return $involvedWallets;
    }

}
