<?php

namespace App\Containers\Authorization\Models;

use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;

class OtpToken extends Model
{
    protected $table = 'otp_tokens';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getLatestUnusedOtp(string $mobile, string $reason, string $driver = 'SMS')
    {
        return self::where('via', $mobile)
            ->where('used', false)
            ->where('reason', $reason)
            ->where('driver', $driver)
            ->orderBy('id', 'DESC')
            ->first();
    }

    public function markAsUsed(): bool
    {
        $this->used = true;

        return $this->save();
    }
}
