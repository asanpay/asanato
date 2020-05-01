<?php

namespace App\Containers\Wallet\Models;

use App\Containers\Merchant\Models\Merchant;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\Wallet\Enum\WalletType;
use App\Ship\Parents\Models\Model;

class Wallet extends Model
{
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
    return $this->belongsToMany(Merchant::class, 'merchant_wallet');
  }

  public function transactions()
  {
    return $this->hasMany(Transaction::class, 'wallet_id', 'id');
  }

  public function getTransferLimitAttribute($value): int
  {
    $limit = config('finance.limit.transfer.max');
    $limit = max($limit, intval($value));

    return $limit;
  }

  public function getBalance()
  {
    return $this->balance - $this->locked_balance;
  }

  public function getTransactionsProfitWallet(): self
  {
    return $this->where('belongs_to_app', true)
      ->where('type', WalletType::TRANSACTION_PROFIT)
      ->firstOrFail();
  }

  public static function getCreateWalletProfitWallet(): self
  {
    return self::where('belongs_to_app', true)
      ->where('type', WalletType::WALLET_COST_PROFIT)
      ->firstOrFail();
  }
}
