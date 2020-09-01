<?php

namespace App\Containers\Withdrawal\Tasks;

use App\Containers\Withdrawal\Enum\WithdrawalStatus;
use App\Containers\Withdrawal\Models\Withdrawal;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class RejectWithdrawalTask extends Task
{

    public function run(Withdrawal $withdrawal, int $userId, string $ip, string $reason = ''): Withdrawal
    {
        try {
            $withdrawal->status = WithdrawalStatus::REJECTED;
            $withdrawal->addToJsonb('reject_reason', $reason, false);
            $withdrawal->addToJsonb('rejected_by', $userId, false);
            $withdrawal->addToJsonb('rejected_ip', $ip, false);

            $withdrawal->save();

            return $withdrawal;
        }
        catch (Exception $exception) {
            XLog::exception($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
