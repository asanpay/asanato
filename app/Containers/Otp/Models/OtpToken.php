<?php

namespace App\Containers\Otp\Models;

use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;

class OtpToken extends Model
{
    protected $table = 'otp_tokens';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLatestUnusedOtp(string $mobile, string $reason, string $broker = 'mobile')
    {
        return self::where('to', $mobile)
            ->where('used', false)
            ->where('reason', $reason)
            ->where('broker', $broker)
            ->orderBy('id', 'DESC')
            ->first();
    }

    public function markAsUsed(): bool
    {
        $this->used = true;

        return $this->save();
    }

    public function verify(int $token): bool
    {
        if (config('otp-container.bypath') == true) {
            return true;
        }

        if ($this->used !== false) {
            return false;
        }

        return intval($this->token) === intval($token);
    }
}
