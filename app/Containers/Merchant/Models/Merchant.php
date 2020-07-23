<?php

namespace App\Containers\Merchant\Models;

use App\Containers\Wallet\Enum\WageBy;
use App\Containers\Wallet\Enum\WagePolicy;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\User\Models\User;
use App\Containers\Wallet\Models\Wallet;
use App\Exception;
use App\Ship\Parents\Models\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use stdClass;

class Merchant extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [

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
    protected $resourceKey = 'merchants';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'merchant_id');
    }

    public function wallets()
    {
        return $this->belongsToMany(Wallet::class, 'merchant_wallet')
            ->orderBy('share', 'DESC')
            ->withPivot('share');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function findByCode(string $apiKey): ?self
    {
        return $this->where('code', $apiKey)
            ->first();
    }

    /**
     * @param int $amount
     *
     * @return stdClass
     * @throws Exception
     */
    public function calculatePayable(int $amount): stdClass
    {
        $r                 = new stdClass();
        $r->amount         = $amount;
        $r->payable_amount = $amount;
        $r->merchant_share = $amount;

        switch ($this->wage_policy) {
            case WagePolicy::TURNOVER:
            {
                $extra = 0;
                break;
            }
            case WagePolicy::PERMANENT:
            {
                $extra = min($this->wage_value, $this->wage_max);
                break;
            }
            case WagePolicy::PERCENT:
            {
                $extra = round($amount * $this->wage_value / 100);
                $extra = min($extra, $this->wage_max);
                break;
            }
            default:
            {
                throw new Exception('Wage policy not defined');
                break;
            }
        }
        $r->wage = $extra;

        if ($this->wage_by == WageBy::CUSTOMER) {
            $r->payable_amount = $amount + $extra;
            $r->merchant_share = $amount;
        } else {
            // by Merchant
            $r->payable_amount = $amount;
            $r->merchant_share = $amount - $extra;
        }

        return $r;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('logo')
            ->width(env('LOGO_SIZE', 256))
            ->height(env('LOGO_SIZE', 256))
            ->sharpen(10);
    }
}
