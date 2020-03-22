<?php

namespace App\Models;

namespace App\Containers\Wallet\Models;

use App\Containers\Transaction\Models\Transaction;
use App\Containers\Wallet\Enum\WalletTransactionType;
use App\Ship\Parents\Models\Model;

class WalletTransaction extends Model
{
    protected $table = 'wallets_transactions';

    protected $guarded = [
        'balance'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

    public function transaction()
    {
        switch ($this->type)
        {
            case WalletTransactionType::MERCHANT: {
                return $this->belongsTo(Transaction::class, 'transaction_id');
            }
            default: {
                throw new Exception('Not handled wallet transaction type!');
            }
        }
    }

}
