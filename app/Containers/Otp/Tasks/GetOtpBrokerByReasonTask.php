<?php

namespace App\Containers\Otp\Tasks;

use App\Containers\Otp\Exceptions\InvalidOTPReasonException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class GetOtpBrokerByReasonTask extends Task
{

    public function run(string $reason): string
    {
        $brokers = Config::get('otp-container.brokers');

        foreach ($brokers as $broker => $reasons) {
            $reasons = explode(',', $reasons);
            if (in_array($reason, $reasons)) {
                return $broker;
            }
        }
        throw new InvalidOTPReasonException(sprintf('could not find otp broker for %s', $reason));
    }
}
