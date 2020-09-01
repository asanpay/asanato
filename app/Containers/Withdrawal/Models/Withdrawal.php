<?php

namespace App\Containers\Withdrawal\Models;

use App\Ship\Parents\Models\Model;
use App\Ship\Traits\JsonbField;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{
    protected $table = 'withdrawals';

    use SoftDeletes;
    use JsonbField;

    protected $guarded = ['id'];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'meta' => 'json'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'withdrawals';

    public function wallet()
    {
        return $this->belongsTo('App\Containers\Wallet\Models\Wallet', 'wallet_id', 'id');
    }

    public function bankAccount()
    {
        return $this->belongsTo('App\Containers\BankAccount\Models\BankAccount', 'bank_account_id', 'id');
    }

    public function tagify()
    {
        return "with{$this->id}draw";
    }

    public function totalAmount()
    {
        return $this->amount + $this->fee;
    }
}
