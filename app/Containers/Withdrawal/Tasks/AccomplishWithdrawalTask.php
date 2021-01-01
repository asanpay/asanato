<?php

namespace App\Containers\Withdrawal\Tasks;

use App\Containers\Withdrawal\Enum\WithdrawalStatus;
use App\Containers\Withdrawal\Models\Withdrawal;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class AccomplishWithdrawalTask extends Task
{

    public function run(Withdrawal $withdrawal, int $userId, string $ip, string $trackingId): Withdrawal
    {
        try {
            $withdrawal->status      = WithdrawalStatus::DONE;
            $withdrawal->tracking_id = $trackingId;

            $withdrawal->addToJsonb('accomplished_by', $userId, false);
            $withdrawal->addToJsonb('accomplished_ip', $ip, false);

            $withdrawal->save();

            return $withdrawal;
        } catch (Exception $exception) {
            XLog::exception($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
