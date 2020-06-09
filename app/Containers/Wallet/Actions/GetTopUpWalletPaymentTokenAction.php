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

        $user = $request->user();

        $data = [
            'type'           => TransactionType::WALLET_TOPUP,
            'user_id'        => $user->id,
            'wallet_id'      => $request->getInputByKey('wallet_id'),
            'amount'         => $request->input('amount'),
            'payable_amount' => $request->input('amount'),
            'merchant_share' => $request->input('amount'),
            'callback_url'   => $request->input('callback_url', $this->getInternalCallbackUrl($request->input('is_mobile_app'))),
            'invoice_number' => trim($request->input('invoice_id')),
            'description'    => trim($request->input('description')),
            'payer_name'     => $user->full_name,
            'payer_email'    => emailify($user->email),
            'payer_mobile'   => mobilify($user->mobile, '0'),
        ];

        $jsonb = [];

        $t = Apiato::call('Transaction@CreateTransactionTask', [$data, $jsonb]);

        return [
            'code'        => 0,
            'token'       => $t->token,
            'date'        => $t->created_at,
            'jalali_date' => $t->j_created_at,
            'x_track_id'  => resolve('xTrackId'),
            'gate_url'    => route('web_ipg_gateway', ['token' => $t->token]),
        ];
    }

    protected function getInternalCallbackUrl(bool $isMobileApp) :string
    {
        if ($isMobileApp) {
            return config('wallet-container.internal_callback.mobile');
        } else {
            return config('wallet-container.internal_callback.web');
        }
    }
}
