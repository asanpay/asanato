<?php

namespace App\Containers\Tx\Models;

use App\Containers\Transaction\Models\Transaction;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Models\Model;
use App\Exception;

class Tx extends Model
{
    protected $table = 'txes';

    protected $guarded = [
        'balance',
    ];

    protected $fillable = [

    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'meta' => 'json',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'txes';

    const UPDATED_AT = null;

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

    public function transaction()
    {
        switch ($this->type) {
            case TxType::MERCHANT:
                return $this->belongsTo(Transaction::class, 'transaction_id');
                break;
            default:
                throw new Exception('Not handled wallet transaction type!');
                break;
        }
    }

    public function getTrackingIdAttribute($value): string
    {
        return 'TX' .
            date('y') .
            str_pad(date('z'), 3, "0", STR_PAD_LEFT) .
            strrev($this->id);
    }
}
