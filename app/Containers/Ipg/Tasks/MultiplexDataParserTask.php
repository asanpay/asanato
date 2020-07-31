<?php
declare(strict_types = 1);

namespace App\Containers\Ipg\Tasks;

use App\Containers\Ipg\Enum\MultiplexType;
use App\Containers\Ipg\Enum\RequestTokenErrors;
use App\Containers\Merchant\Models\Merchant;
use App\Containers\Wallet\Enum\WageBy;
use App\Exception;
use App\Ship\Parents\Tasks\Task;
use Hashids\Hashids;

class MultiplexDataParserTask extends Task
{
    private $wagePayerWalletDefined = false;
    /**
     * @param array $parameters
     *
     * @return array
     *
     *
     * "multiplex" : {
     *      "method": "percent",
     *      "wallets": [
     *          {"wallet":"foo", "share": 20, "wage": true},
     *          {"wallet":"bar", "share": 40},
     *          {"wallet":"baz", "share": 20},
     *      ]
     * }
     *
     *
     * "multiplex" : {
     *      "method": "defined",
     *      "wallets": [
     *          {"wallet":"foo", "share": 2000, "wage": true},
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
        $multiplex       = json_decode($parameters['multiplex'], true);
        $multiplexMethod = strtolower($multiplex['method']) ?? null;
        $multiplexWallets = $multiplex['wallets'] ?? [];

        if (!in_array($multiplexMethod, MultiplexType::toArray())) {
            self::error('multiplexing method should be in: ' . MultiplexType::commaSeparated());
        }

        if (!is_array($multiplexWallets) || count($multiplexWallets) < 1) {
            self::error('multiplexing wallets should be an array');
        }

        $wallets           = [];
        $wagePayerWalletId = null;
        $percentage        = 0;
        $shares            = 0;
        $wagePayerWalletsCount = 0;

        // parse and validate multiplex json
        foreach ($multiplexWallets as $item) {
            switch (count($item)) {
                case 2:
                {
                    if (!isset($item['wallet'], $item['share'])) {
                        self::error('each multiplex item could contains just wallet, share and wage keys');
                    }
                    break;
                }
                case 3:
                {
                    if (!isset($item['wallet'], $item['share'], $item['wage'])) {
                        self::error('each multiplex item could contains just wallet, share and wage keys');
                    }
                    $wagePayerWalletsCount++;
                    break;
                }
                default:
                {
                    // invalid item structure
                    self::error('each multiplex item should contains 2 or 3 items from wallet, share and wage keys');
                    break;
                }
            }

            $w = app(Hashids::class)->decode($item['wallet']);

            if (empty($w)) {
                // if could not decode hashed ID
                self::error(sprintf("'%s' wallet is not a valid wallet id", $item['wallet']));
            }
            $wallets [] = $w[0];

            // only check if MERCHANT is responsible for paying the transaction wage otherwise ignore wage checkup
            if ($merchant->wage_by == WageBy::MERCHANT) {
                if (isset($item['wage']) && $item['wage'] == true) {
                    $wagePayerWalletId = $item['wallet'];

                    $paymentInfo = $merchant->calculatePayable(currency($parameters['amount']));

                    if ($multiplexMethod == MultiplexType::PERCENT) {
                        $payerWalletTotalShare = currency($item['share'] / 100 * $parameters['amount']);
                    } else {
                        $payerWalletTotalShare = $item['share'];
                    }

                    // check if selected wallet share is enough to pay the transaction fee
                    if ($payerWalletTotalShare < $paymentInfo->wage) {
                        self::error('transaction wage value is bigger than the share of the wallet that you have selected as wage payer');
                    }

                    $this->wagePayerWalletDefined = true;
                }
            }

            if ($multiplexMethod == MultiplexType::PERCENT) {
                $percentage += $item['share'];
            } else {
                $shares += $item['share'];
            }
        }

        if ($wagePayerWalletsCount != 1) {
            self::error(sprintf('One wallet should be select to pay the transaction fee. You selected %d', $wagePayerWalletsCount));
        }

        if ($merchant->wage_by == WageBy::MERCHANT && $this->wagePayerWalletDefined !== true) {
            self::error('The transaction fee payer\'s wallet is not specified');
        }

        if ($multiplexMethod == MultiplexType::PERCENT && $percentage !== 100) {
            self::error('The sum of the multiplexing shares is not 100%');
        } elseif ($multiplexMethod == MultiplexType::FIXED && $shares !== $parameters['amount']) {
            self::error('The sum of the multiplexing shares is not equals to transaction amount');
        }

        return [
            'method'            => $multiplexMethod,
            'wallets'           => $wallets,
            'wagePayerWalletId' => $wagePayerWalletId,
        ];
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
