<?php

namespace App\Containers\Otp\Tasks;

use App\Ship\Parents\Tasks\Task;
use Google2FA;

class GenerateGoogleAuthQrCodeTask extends Task
{

    public function run($mobile, $secret): string
    {
        return Google2FA::getQRCodeInline(
            config('app.company'),
            $mobile,
            $secret
        );
    }
}
