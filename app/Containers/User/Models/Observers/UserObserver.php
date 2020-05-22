<?php

namespace App\Containers\User\Models\Observers;


use App\Containers\User\Models\User;
use Google2FA;

class UserObserver
{
    public function creating(User $user)
    {
        // before create ::
        if (empty($user->google2fa_secret)) {
            $user->google2fa_secret =  Google2FA::generateSecretKey(
                config('google2fa.key.size', 25),
                config('google2fa.key.prefix', '')
            );
        }
    }

}
