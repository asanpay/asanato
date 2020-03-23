<?php

namespace App\Containers\User\Models;

use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\Profile\Enum\IdPoofType;
use App\Containers\Profile\Enum\VerificationStatus;
use App\Containers\Profile\Models\UserVerification;
use App\Ship\Parents\Models\UserModel;
use Illuminate\Notifications\Notifiable;
use Tartan\Zaman\Facades\Zaman;

/**
 * Class User.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class User extends UserModel
{
    use AuthorizationTrait;
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'device',
        'platform',
        'gender',
        'birth',
        'social_provider',
        'social_token',
        'social_refresh_token',
        'social_expires_in',
        'social_token_secret',
        'social_id',
        'social_avatar',
        'social_avatar_original',
        'social_nickname',
        'confirmed',
        'referrer',
        'register_ip'
    ];

    protected $casts = [
        'is_client' => 'boolean',
        'confirmed' => 'boolean',
    ];

    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //relations ============================================================================================


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function merchants()
    {
        return $this->hasMany(Merchant::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'user_id')
            ->orderBy('id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verifications()
    {
        return $this->hasMany(UserVerificationModel::class, 'user_id');
    }

    /**
     * @param Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        // Perform a resize on every collection
        $this->addMediaConversion('avatar')
            ->width(env('AVATAR_SIZE', 256))
            ->height(env('AVATAR_SIZE', 256));
    }

    /**
     * @param int $size
     *
     * @return string
     */
    public function getAvatar($size = 30): string
    {
        if (count($this->getMedia('avatar'))) {
            return $this->getFirstMediaUrl('avatar');
        }

        if (isset($this->avatar_social) && !empty($this->avatar_social)) {
            return $this->avatar_social;
        }

        if ($this->email == null) {
            return '';
        }

        return Gravatar::get($this->email, ['size' => $size]);

    }

    public function getJBirthDateAttribute(): string
    {
        return english(Zaman::gToj($this->birth_date, 'yyyy/MM/dd'));
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getMobileAttribute($value): string
    {
        if (!empty($value)) {
            return "0{$value}";
        } else {
            return '';
        }
    }

    /**
     * @return array
     */
    public function getVerifications(): array
    {
        $r              = [];
        $r['mobile']    = ['value' => $this->mobile, 'status' => $this->verification & IdPoofType::MOBILE];
        $r['email']     = ['value' => $this->email, 'status' => $this->verification & IdPoofType::EMAIL];
        $r['tel']       = ['value' => $this->tel, 'status' => $this->verification & IdPoofType::TEL];
        $r['residency'] = ['value'  => $this->residency,
                           'status' => $this->verification & IdPoofType::RESIDENCY,
        ];
        $r['identity']  = ['value'  => $this->identity,
                           'status' => $this->verification & IdPoofType::IDENTITY,
        ];
        $r['company']   = ['value' => $this->company, 'status' => $this->verification & IdPoofType::COMPANY];

        return $r;
    }

    /**
     * @param int $type
     *
     * @return bool
     */
    public function isVerified(int $type): bool
    {
        return $this->verification & $type;
    }


    /**
     * @param int $type
     *
     * @return bool
     */
    public function hasPendingVerification(int $type): bool
    {
        $pendingRequest = UserVerification::where('user_id', $this->id)
            ->where('status', VerificationStatus::PENDING)
            ->where('verification_type', $type)
            ->first();
        if ($pendingRequest != null) {
            return true;
        }

        return false;
    }

    /**
     * @param int $type
     *
     * @return bool
     */
    public function verify(int $type): bool
    {
        if (!($this->verification & $type)) {
            $this->verification += $type;

            return $this->save();
        }

        return true;
    }

    /**
     * @return bool
     */
    public function fullVerified(): bool
    {

        return $this->verification & IdPoofType::MOBILE &&
            $this->verification & IdPoofType::EMAIL &&
            $this->verification & IdPoofType::TEL &&
            $this->verification & IdPoofType::RESIDENCY &&
            $this->verification & IdPoofType::IDENTITY;
    }

    /**
     * @param int $type
     *
     * @return string
     * @throws Exception
     */
    public function getVerificationValue(int $type): string
    {
        switch ($type) {
            case IdPoofType::MOBILE:
            {
                return $this->mobile;
            }
            case IdPoofType::EMAIL:
            {
                return $this->email;
            }
            case IdPoofType::IDENTITY:
            {
                return $this->national_id;
            }
            default:
            {
                throw new Exception(sprintf('could not find user verification value for: %s', $type));
            }
        }
    }

    public function __call($method, $parameters)
    {
        if (preg_match('/^isVerified(.+)$/', $method, $matches)) {
            $item = strtoupper($matches[1]);
            $item = constant(IdPoofType::class . '::' . $item);

            return $this->isVerified($item);
        }

        return parent::__call($method, $parameters); // TODO: Change the autogenerated stub
    }

}
