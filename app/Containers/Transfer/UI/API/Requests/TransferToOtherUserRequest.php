<?php

namespace App\Containers\Transfer\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class TransferToOtherUserRequest
 * @package App\Containers\Transfer\UI\API\Requests
 */
class TransferToOtherUserRequest extends Request
{
    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        'src_wallet_id',
        'dst_user_id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        $userId              = intval($this->user()->id);
        $walletToWalletLimit = currency(config('transfer-container.limit.wallet_to_wallet'));

        return [
            'amount'        => "required|numeric|min:$walletToWalletLimit",
            'description'   => 'nullable|string|max:64',
            'src_wallet_id' => "required|different:dst_wallet_id|exists:wallets,id,user_id,{$userId}",
            'dst_user_id'   => "required|exists:users,id,locked,false|not_in:{$userId}",
            'client_ip'     => 'required|ip',
            'token'         => "required|numeric|min:1000"
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
