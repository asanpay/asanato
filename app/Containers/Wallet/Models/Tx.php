<?php

namespace App\Models;

namespace App\Containers\Wallet\Models;

use App\Containers\Transaction\Models\Transaction;
use App\Containers\Wallet\Enum\TxType;
use App\Ship\Parents\Models\Model;

class Tx extends Model
{
    protected $table = 'wallets_transactions';

    protected $guarded = [
        'balance',
    ];

    const UPDATED_AT = null;

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

    public function transaction()
    {
        switch ($this->type)
        {
            case TxType::MERCHANT: {
                return $this->belongsTo(Transaction::class, 'transaction_id');
            }
            default: {
                throw new Exception('Not handled wallet transaction type!');
            }
        }
    }

    public function getTrackingIdAttribute($value): int
    {
        return date('y') .
            str_pad(date('z'), 3, "0", STR_PAD_LEFT) .
            strrev($this->id);
    }
}
