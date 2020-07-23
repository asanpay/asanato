<?php
declare(strict_types = 1);

namespace App\Containers\Ipg\Tasks;

use App\Containers\Ipg\Enum\MultiplexType;
use App\Containers\Ipg\Enum\RequestTokenErrors;
use App\Containers\Merchant\Models\Merchant;
use App\Containers\Wallet\Enum\WageBy;
use App\Exception;
use App\Ship\Parents\Tasks\Task;

class MultiplexDataParserTask extends Task
{
    /**
     * @param array $parameters
     *
     * @return array
     *
     *
     * "multiplex" : {
     *      "method": "percent",
     *      "wallets": [
     *          {"wallet_id":"foo", "share": 20, "wage": true},
     *          {"wallet_id":"bar", "share": 40},
     *          {"wallet_id":"baz", "share": 20},
     *      ]
     * }
     *
     *
     * "multiplex" : {
     *      "method": "defined",
     *      "wallets": [
     *          {"wallet_id":"foo", "share": 2000, "wage": true},
     *          {"wallet_id":"bar", "share": 4500},
     *          {"wallet_id":"baz", "share": 230000"},
     *      ]
     * }
     *
     */
    public function run(array $parameters, Merchant $merchant): array
    {
        // multiplex data should be a json
        if (!isset($parameters['multiplex']) || !isJson($parameters['multiplex'])) {

            throw new Exception(
                'multiplexing data should be a json array',
                null,
                422,
                RequestTokenErrors::INVALID_MULTIPLEX_DATA
            );
        }
        $multiplex       = json_decode($parameters['multiplex'], true);
        $multiplexMethod = strtolower($multiplex['method']) ?? null;

        if (!in_array($multiplexMethod, MultiplexType::toArray())) {
            throw new Exception(
                'multiplexing method should be in: ' . MultiplexType::commaSeparated(),
                null,
                422,
                RequestTokenErrors::INVALID_MULTIPLEX_DATA
            );
        }

        $wallets           = [];
        $wagePayerWalletId = null;
        $percentage        = 0;
        $shares            = 0;

        // parse and validate multiplex json
        foreach ($multiplex as $item) {
            switch (count($item)) {
                case 2:
                {
                    if (!isset($item->wallet, $item->share)) {
                        throw new Exception(
                            'each multiplex item could contains just wallet, share and wage keys',
                            null,
                            422,
                            RequestTokenErrors::INVALID_MULTIPLEX_DATA
                        );
                    }
                    break;
                }
                case 3:
                {
                    if (!isset($item->wallet, $item->share, $item->wage)) {
                        throw new Exception(
                            'each multiplex item could contains just wallet, share and wage keys',
                            null,
                            422,
                            RequestTokenErrors::INVALID_MULTIPLEX_DATA
                        );
                    }
                    break;
                }
                default:
                {
                    // invalid item structure
                    throw new Exception(
                        'each multiplex item should contains 2 or 3 items from wallet, share and wage keys',
                        null,
                        422,
                        RequestTokenErrors::INVALID_MULTIPLEX_DATA
                    );
                    break;
                }
            }

            $wallets [] = $item->wallet;

            // only check if MERCHANT is responsible for paying the transaction wage otherwise ignore wage checkup
            if ($merchant->wage_by = WageBy::MERCHANT) {
                if (isset($item->wage) && $item->wage == true) {
                    $wagePayerWalletId = $item->wallet;

                    $paymentInfo = $merchant->calculatePayable($parameters['amount']);

                    // check if selected wallet share is bigger than the transaction amount
                    if ($item->share < $paymentInfo->wage) {
                        throw new Exception(
                            'transaction wage value is bigger than the share of the wallet that you have selected as wage payer',
                            null,
                            422,
                            RequestTokenErrors::INVALID_MULTIPLEX_DATA
                        );
                    }
                }
            }

            if ($multiplexMethod == MultiplexType::PERCENT) {
                $percentage += $item->share;
            } else {
                $shares += $item->share;
            }
        }

        if ($multiplexMethod == MultiplexType::PERCENT && $percentage !== 100) {
            throw new Exception(
                'The sum of the multiplexing shares is not 100%',
                null,
                422,
                RequestTokenErrors::INVALID_MULTIPLEX_DATA
            );
        } elseif ($multiplexMethod == MultiplexType::DEFINED && $shares !== $parameters['amount']) {
            throw new Exception(
                'The sum of the multiplexing shares is not equals to transaction amount',
                null,
                422,
                RequestTokenErrors::INVALID_MULTIPLEX_DATA
            );
        }

        return [
            'method'            => $multiplexMethod,
            'wallets'           => $wallets,
            'wagePayerWalletId' => $wagePayerWalletId,
        ];
    }
}
