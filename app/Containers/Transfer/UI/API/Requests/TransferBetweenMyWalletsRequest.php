<?php

namespace App\Containers\Transfer\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class TransferBetweenMyWalletsRequest.
 */
class TransferBetweenMyWalletsRequest extends Request
{
    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
        'src_wallet_id',
        'dst_wallet_id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        $userId = intval($this->user()->id);
        $walletToWalletLimit = currency(config('transfer-container.limit.wallet_to_wallet'));

        return [
            'amount'        => "required|numeric|min:$walletToWalletLimit",
            'description'   => 'nullable|string|max:64',
            'src_wallet_id' => "required|different:dst_wallet_id|exists:wallets,id,user_id,{$userId}",
            'dst_wallet_id' => "required|different:src_wallet_id|exists:wallets,id,user_id,{$userId}",
        ];
    }
}
