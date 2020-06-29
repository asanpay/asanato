<?php

namespace App\Containers\BankAccount\Models;

use App\Containers\BankAccount\Enum\BankAccountStatus;
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

    public function user()
    {
        return $this->belongsTo('App\Containers\User\Models\User', 'user_id', 'id');
    }

    public function getShebaAttribute(): string
    {
        return 'IR'. $this->iban;
    }

    public function isApproved(): bool
    {
        return $this->status === BankAccountStatus::APPROVED;
    }

    public function isDefault(): bool
    {
        return boolval($this->default) === true;
    }
}
