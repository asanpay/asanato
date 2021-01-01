<?php

namespace App\Containers\Withdrawal\Tasks;

use App\Containers\Withdrawal\Data\Repositories\WithdrawalRepository;
use App\Containers\Withdrawal\Enum\WithdrawalStatus;
use App\Containers\Withdrawal\Models\Withdrawal;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

class DeleteWithdrawalTask extends Task
{

    protected $repository;

    public function __construct(WithdrawalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Withdrawal $withdrawal, int $userId, string $ip)
    {
        try {
            $withdrawal->deleted_at = Carbon::now();
            $withdrawal->status = WithdrawalStatus::CANCELED;
            $withdrawal->meta = array_merge(
                $withdrawal->meta,
                [
                    'deleted_by' => $userId,
                    'deleted_ip' => $ip
                ]
            );
            if ($withdrawal->save()) {
                return $withdrawal;
            }
        } catch (Exception $exception) {
            XLog::exception($exception);
            throw new DeleteResourceFailedException();
        }
    }
}
