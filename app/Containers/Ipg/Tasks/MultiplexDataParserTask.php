<?php
declare(strict_types = 1);

namespace App\Containers\Ipg\Tasks;

use App\Containers\Ipg\Enum\MultiplexType;
use App\Containers\Ipg\Enum\RequestTokenErrors;
use App\Containers\Merchant\Models\Merchant;
use App\Containers\Merchant\Enum\FeeBy;
use App\Exception;
use App\Ship\Parents\Tasks\Task;
use Hashids\Hashids;

class MultiplexDataParserTask extends Task
{
    private $feePayerWalletDefined = false;

    /**
     * @param array $parameters
     *
     * @return array
     *
     *
     * "multiplex" : {
     *      "method": "percent",
     *      "wallets": [
     *          {"wallet":"foo", "share": 20, "fee": true},
     *          {"wallet":"bar", "share": 40},
     *          {"wallet":"baz", "share": 20},
     *      ]
     * }
     *
     *
     * "multiplex" : {
     *      "method": "defined",
     *      "wallets": [
     *          {"wallet":"foo", "share": 2000, "fee": true},
     *          {"wallet":"bar", "share": 4500},
     *          {"wallet":"baz", "share": 230000"},
     *      ]
     * }
     *
     */
    public function run(array $parameters, Merchant $merchant): array
    {
        // multiplex data should be a json
        if (!isset($parameters['multiplex']) || !isJson($parameters['multiplex'])) {

            self::error('multiplexing data should be a json array');
        }
        $multiplex        = json_decode($parameters['multiplex'], true);
        $multiplexMethod  = strtolower($multiplex['method']) ?? null;
        $multiplexWallets = $multiplex['wallets'] ?? [];

        if (!in_array($multiplexMethod, MultiplexType::toArray())) {
            self::error('multiplexing method should be in: ' . MultiplexType::commaSeparated());
        }

        if (!is_array($multiplexWallets) || count($multiplexWallets) < 1) {
            self::error('multiplexing wallets should be an array');
        }

        $wallets              = [];
        $feePayerWalletId     = null;
        $percentage           = 0;
        $fixShare             = 0;
        $shares               = [];
        $feePayerWalletsCount = 0;

        // parse and validate multiplex json
        foreach ($multiplexWallets as $item) {
            switch (count($item)) {
                case 2:
                {
                    if (!isset($item['wallet'], $item['share'])) {
                        self::error('each multiplex item could contains just wallet, share and fee keys');
                    }
                    break;
                }
                case 3:
                {
                    if (!isset($item['wallet'], $item['share'], $item['fee'])) {
                        self::error('each multiplex item could contains just wallet, share and fee keys');
                    }
                    $feePayerWalletsCount++;
                    break;
                }
                default:
                {
                    // invalid item structure
                    self::error('each multiplex item should contains 2 or 3 items from wallet, share and fee keys');
                    break;
                }
            }

            $w = app(Hashids::class)->decode($item['wallet']);

            if (empty($w)) {
                // if could not decode hashed ID
                self::error(sprintf("'%s' wallet is not a valid wallet id", $item['wallet']));
            }
            $wallets [] = $w[0];
            $shares []  = $item['share'];

            // only check if MERCHANT is responsible for paying the transaction fee otherwise ignore fee checkup
            if ($merchant->fee_by == FeeBy::MERCHANT) {
                if (isset($item['fee']) && $item['fee'] == true) {
                    $feePayerWalletId = $w[0];

                    $paymentInfo = $merchant->calculatePayable(currency($parameters['amount']));

                    if ($multiplexMethod == MultiplexType::PERCENT) {
                        $payerWalletTotalShare = currency($item['share'] / 100 * $parameters['amount']);
                    } else {
                        $payerWalletTotalShare = $item['share'];
                    }

                    // check if selected wallet share is enough to pay the transaction fee
                    if ($payerWalletTotalShare < $paymentInfo->fee) {
                        self::error('transaction fee value is bigger than the share of the wallet that you have selected as fee payer');
                    }

                    $this->feePayerWalletDefined = true;
                }
            }

            if ($multiplexMethod == MultiplexType::PERCENT) {
                $percentage += $item['share'];
            } else {
                $fixShare += $item['share'];
            }
        }

        if ($feePayerWalletsCount > 1) {
            self::error(sprintf('One wallet could be select to pay the transaction fee. You selected %d',
                $feePayerWalletsCount));
        }

        //        if ($merchant->fee_by == FeeBy::MERCHANT && $this->feePayerWalletDefined !== true) {
        //            self::error('The transaction fee payer\'s wallet is not specified');
        //        }

        if ($multiplexMethod == MultiplexType::PERCENT && intval($percentage) !== 100) {
            self::error('The sum of the multiplexing shares is not 100%');
        } elseif ($multiplexMethod == MultiplexType::FIX && $fixShare !== intval($parameters['amount'])) {
            self::error('The sum of the multiplexing shares is not equals to transaction amount');
        }

        $data = [
            'method'  => $multiplexMethod,
            'wallets' => $wallets,
            'shares'  => $shares,
        ];

        if ($feePayerWalletId) {
            $data ['feePayerWallet'] = $feePayerWalletId;
        }

        /**
         * sample output
         *  array:4 [
            "method" => "percentage"
            "wallets" => array:3 [
                0 => 1000111122
                1 => 1000111121
                2 => 1000111111
            ]
            "shares" => array:3 [
                0 => 50
                1 => 49.5
                2 => 0.5
            ]
            "feePayerWallet" => 1000111122
        ]
         */

        return $data;
    }

    private static function error(string $message)
    {
        throw new Exception(
            $message,
            null,
            422,
            RequestTokenErrors::INVALID_MULTIPLEX_DATA
        );
    }
}
