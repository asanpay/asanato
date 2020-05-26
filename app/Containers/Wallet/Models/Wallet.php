<?php

namespace App\Containers\Wallet\Models;

use App\Containers\Merchant\Models\Merchant;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\Wallet\Enum\WalletType;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    protected $table = 'wallets';

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'share',
        'type',
        'name',
        'default',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'wallets';

    public function merchants()
    {
        $this->dateFormat;

        return $this->belongsToMany(Merchant::class, 'merchant_wallet');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'wallet_id', 'id');
    }

    public function txs()
    {
        return $this->hasMany(Tx::class, 'wallet_id', 'id');
    }

    public function getTransferLimitAttribute($value): int
    {
        $limit = config('finance.limit.transfer.max');
        $limit = currency(max($limit, intval($value)));

        return $limit;
    }

    public function getBalance(): int
    {
        return intval($this->balance - $this->locked_balance);
    }

    public function hasBalance(): bool
    {
        // this should support positive and negative balance
        return $this->getBalance() !== 0;
    }

    public function isDefault(): bool
    {
        return boolval($this->default) === true;
    }

    public function belongsToUser(int $userId): bool
    {
        return intval($this->user_id) === $userId;
    }

    public function getTransactionsProfitWallet(): self
    {
        return $this->where('belongs_to_app', true)
            ->where('type', WalletType::TRANSACTION_PROFIT)
            ->firstOrFail();
    }

    public function getCreateWalletProfitWallet(): self
    {
        return self::where('belongs_to_app', true)
            ->where('type', WalletType::WALLET_COST_PROFIT)
            ->firstOrFail();
    }
}
