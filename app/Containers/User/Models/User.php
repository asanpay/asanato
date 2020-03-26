<?php

namespace App\Containers\User\Models;

use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\IdentityProof\Enum\IdPoofType;
use App\Containers\IdentityProof\Enum\IdProofStatus;
use App\Containers\IdentityProof\Models\IdentityProof;
use App\Containers\Merchant\Models\Merchant;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Models\UserModel;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Notifications\Notifiable;
use Tartan\Zaman\Facades\Zaman;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Exception;

/**
 * Class User.
 */
class User extends UserModel implements HasMedia
{
    use AuthorizationTrait;
    use Notifiable;
    use InteractsWithMedia;

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
    ];

    protected $guarded = ['id', 'balance', 'idproofs'];

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
    public function identityProofs()
    {
        return $this->hasMany(IdentityProof::class, 'user_id');
    }

    /**
     * @param Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
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

    public function getJBirthDateAttribute(): ?string
    {
        if (!empty($this->birth_date)) {
            return Zaman::gToj($this->birth_date, 'yyyy/MM/dd', 'en');
        } else {
            return null;
        }
    }

    public function getJCreatedAtAttribute(): ?string
    {
        if (!empty($this->created_at)) {
            return Zaman::gToj($this->created_at, 'yyyy/MM/dd', 'en');
        } else {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getMobileAttribute($value): ?string
    {
        if (!empty($value)) {
            return mobilify($value, '0');
        } else {
            return null;
        }
    }

    /**
     * @return array
     */
    public function getIdProofs(): array
    {
        $r              = [];
        $r['mobile']    = ['value' => $this->mobile, 'status' => $this->idproofs & IdPoofType::MOBILE];
        $r['email']     = ['value' => $this->email, 'status' => $this->idproofs & IdPoofType::EMAIL];
        $r['tel']       = ['value' => $this->tel, 'status' => $this->idproofs & IdPoofType::TEL];
        $r['residency'] = ['value' => $this->residency, 'status' => $this->idproofs & IdPoofType::RESIDENCY,];
        $r['identity']  = ['value' => $this->identity, 'status' => $this->idproofs & IdPoofType::IDENTITY,];
        $r['company']   = ['value' => $this->company, 'status' => $this->idproofs & IdPoofType::COMPANY];

        return $r;
    }

    /**
     * @param int $type
     *
     * @return bool
     */
    public function isProved(int $type): bool
    {
        return $this->idproofs & $type;
    }


    /**
     * @param int $type
     *
     * @return bool
     */
    public function hasPendingIdProofs(int $type): bool
    {
        $pendingRequest = IdentityProof::where('user_id', $this->id)
            ->where('status', IdProofStatus::PENDING)
            ->where('proof_type', $type)
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
        if (!($this->idproofs & $type)) {
            $this->idproofs += $type;

            return $this->save();
        }

        return true;
    }

    /**
     * @return bool
     */
    public function fullIdProven(): bool
    {
        return $this->idproofs & IdPoofType::MOBILE &&
            $this->idproofs & IdPoofType::EMAIL &&
            $this->idproofs & IdPoofType::TEL &&
            $this->idproofs & IdPoofType::RESIDENCY &&
            $this->idproofs & IdPoofType::IDENTITY;
    }

    /**
     * @param int $type
     *
     * @return string
     * @throws Exception
     */
    public function getProofValue(int $type): string
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
            case IdPoofType::RESIDENCY:
            {
                return $this->address;
            }
            case IdPoofType::TEL:
            {
                return $this->tel;
            }
            default:
            {
                throw new Exception(sprintf('could not find user id proof value for: %s', $type));
            }
        }
    }

    public function __call($method, $parameters)
    {
        if (preg_match('/^isProved(.+)$/', $method, $matches)) {
            $item = strtoupper($matches[1]);
            $item = constant(IdPoofType::class . '::' . $item);

            return $this->isProved($item);
        }

        return parent::__call($method, $parameters); // TODO: Change the autogenerated stub
    }
}
