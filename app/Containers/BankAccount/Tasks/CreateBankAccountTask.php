<?php

namespace App\Containers\BankAccount\Tasks;

use App\Containers\BankAccount\Data\Repositories\BankAccountRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

class CreateBankAccountTask extends Task
{
    protected $repository;

    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            $makeDefault = boolval($data['default'] ?? false);

            // remove default flag from all other user accounts
            if ($makeDefault === true) {
                DB::update('update bank_accounts set "default" = false where user_id = ?', [$data['user_id']]);
            }

            return $this->repository->create($data);
        } catch (Exception $exception) {
            XLog::exception($exception);
            throw new CreateResourceFailedException();
        }
    }
}
