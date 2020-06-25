<?php

namespace App\Containers\BankAccount\Models;

use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'iban',
        'user_id',
        'ip_address',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'bank_accounts';

    public function getShebaAttribute(): string
    {
        return 'IR'. $this->iban;
    }
}
