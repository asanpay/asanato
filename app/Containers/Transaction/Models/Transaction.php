<?php

namespace App\Containers\Transaction\Models;

use App\Containers\Transaction\Enum\TransactionProcess;
use App\Containers\Transaction\Enum\TransactionStatus;
use App\Containers\Bank\Models\Gateway;
use App\Containers\Merchant\Models\Merchant;
use App\Containers\Bank\Models\Psp;
use App\Ship\Models\Serial;
use App\Containers\User\Models\User;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Models\Model;
use App\Ship\Traits\Jalali;
use App\Ship\Traits\JsonbField;
use App\Containers\Transaction\Traits\ShaparakIntegration;
use Asanpay\Shaparak\Contracts\Transaction as TransactionInterface;

class Transaction extends Model implements TransactionInterface
{
    use JsonbField, Jalali, ShaparakIntegration;

    protected $fillable = [

    ];

    protected $guarded = [
        'id'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'gateway_callback_params' => 'json',
        'meta' => 'json',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'transactions';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }

    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'gateway_id', 'id');
    }

    public function psp()
    {
        return $this->belongsTo(Psp::class, 'psp_id', 'id');
    }

    public function getTokenAttribute()
    {
        return $this->flag . "-" . $this->id;
    }

    public function getJCreatedAtAttribute($value)
    {
        return is_null($value) ? null : self::formatJalali($value, 'yyyy/MM/dd HH:mm:ss');
    }

    public function getJVerifiedAtAttribute()
    {
        return is_null($this->verified_at) ? null : self::jalaliDate($this->verified_at, 'yyyy/MM/dd HH:mm:ss', 'en');
    }

    public function getJRefundedAtAttribute()
    {
        return is_null($this->refunded_at) ? null : self::jalaliDate($this->refunded_at, 'yyyy/MM/dd HH:mm:ss', 'en');
    }

    public function getJAccomplishedAtAttribute($value)
    {
        return is_null($value) ? null : self::formatJalali($value, 'yyyy/MM/dd HH:mm:ss');
    }

    public function getBenefitAttribute(): int
    {
        return currency($this->payable_amount - $this->merchant_share);
    }

    public function tagify()
    {
        return "tr{$this->id}ans";
    }

    /**
     * @param $token
     *
     * @return Transaction
     */
    public function findByPublicToken($token, array $with = ['psp', 'gateway', 'merchant']): ?self
    {
        list($flag, $id) = explode('-', $token);

        return $this->with($with)
            ->where('id', $id)
            ->where('flag', $flag)
            ->first();
    }

    /**
     * update payment gateway information
     *
     * @param int $pspId
     * @param int $gatewayId
     *
     * @return self
     */
    public function updatePspInfo(int $pspId, int $gatewayId): self
    {
        $this->psp_id     = $pspId;
        $this->gateway_id = $gatewayId;
        $this->save();
        $this->load(['psp', 'gateway']);

        return $this;
    }

    public function getGatewayOrderId(): int
    {
        // if transaction is untouched then generate new
        if ($this->status < TransactionStatus::VERIFIED) {
            $this->gateway_order_id = Serial::getNextVal();
            $this->save();
        }

        return $this->gateway_order_id;
    }

    /**
     * @return bool
     */
    public function isAccomplished()
    {
        return $this->status == TransactionStatus::ACCOMPLISHED;
    }

    /**
     * @return bool
     */
    public function isRefunded()
    {
        return $this->status == TransactionStatus::REFUNDED;
    }


    /**
     * returns all Transactions that required processing
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProcessable($query)
    {
        $query->where(function ($query) {
            $query->where('status', TransactionStatus::ACCOMPLISHED)
                ->where('process', TransactionProcess::NONE); // includes 0
        });
    }

    /**
     * @return bool
     */
    public function pspSupportsRefund(): bool
    {
        return !empty($this->psp) &&
            $this->psp->refund_support == true;
    }

    /**
     * @return bool
     */
    public function isRefundable(): bool
    {
        return $this->pspSupportsRefund() &&
            ((time() - strtotime($this->created_at)) < config('app.refund_respite'));
    }
}
