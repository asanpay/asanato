<?php

namespace App\Containers\Withdrawal\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateWithdrawalRequest.
 */
class CreateWithdrawalRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Withdrawal\Data\Transporters\CreateWithdrawalTransporter::class;

    protected $decode = [
        'wallet_id',
        'bank_account_id',
    ];


    /**
     * @return  array
     */
    public function rules()
    {
        $userId        = intval($this->user()->id);
        $withdrawLimit = config('withdrawal-container.limit');

        return [
            'amount'          => "required|numeric|min:{$withdrawLimit['min']}|max:{$withdrawLimit['max']}",
            'wallet_id'       => "required|exists:wallets,id,user_id,{$userId}",
            'bank_account_id' => "required|exists:bank_accounts,id,user_id,{$userId}",
            'description'     => 'nullable|string|max:64',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(
            [
                'amount' => english($this->getInputByKey('amount')),
            ]
        );
    }
}
