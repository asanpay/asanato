<?php

namespace App\Containers\Wallet\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class TopUpWalletRequest.
 */
class TopUpWalletRequest extends Request
{
    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        'wallet_id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        $userId              = $this->user()->id;
        $walletToWalletLimit = currency(config('transfer-container.limit.wallet_to_wallet'));

        return [
            'amount'        => "required|numeric|min:$walletToWalletLimit",
            'wallet_id'     => "required|numeric|exists:wallets,id|exists:wallets,id,user_id,{$userId}",
            'description'   => 'nullable|string|max:64',
            'callback_url'  => 'nullable|url',
            'is_mobile_app' => 'nullable|boolean',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'amount'    => english($this->getInputByKey('amount')),
                'client_ip' => request('client_ip', $this->getClientIp()),
            ]
        );
    }
}
