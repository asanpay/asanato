<?php

namespace App\Containers\Wallet\Actions;

use App\Containers\Transaction\Enum\TransactionType;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetTopUpWalletPaymentTokenAction extends Action
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function run(Request $request): array
    {
        $data = $request->sanitizeInput([
            'wallet_id',
            'amount',
            'description',
            'client_ip',
            'callback_url',
            'is_mobile_app',
        ]);

        $isMobileApp = boolval($request->input('is_mobile_app', false));

        $user = $request->user();

        $data = [
            'type'           => TransactionType::WALLET_TOPUP,
            'user_id'        => $user->id,
            'wallet_id'      => $request->getInputByKey('wallet_id'),
            'amount'         => currency($request->input('amount')),
            'payable_amount' => currency($request->input('amount')),
            'merchant_share' => currency($request->input('amount')),
            'callback_url'   => $request->input('callback_url', $this->getInternalCallbackUrl($isMobileApp)),
            'invoice_number' => trim($request->input('invoice_id')),

            'payer_name'   => $user->full_name,
            'payer_email'  => emailify($user->email),
            'payer_mobile' => mobilify($user->mobile, '0'),

            'ip_address' => $request->getClientIp(),
            'meta'       => [
                'description' => trim($request->input('description')),
            ],
        ];

        $t = Apiato::call('Transaction@CreateTransactionTask', [$data]);

        return [
            'code'        => 0,
            'token'       => $t->token,
            'date'        => $t->created_at,
            'jalali_date' => $t->j_created_at,
            'x_track_id'  => resolve('xTrackId'),
            'gate_url'    => route('web_ipg_gateway', ['token' => $t->token]),
        ];
    }

    protected function getInternalCallbackUrl(bool $isMobileApp): string
    {
        if ($isMobileApp) {
            return config('ipg-container.internal_callback.mobile');
        } else {
            return config('ipg-container.internal_callback.web');
        }
    }
}
