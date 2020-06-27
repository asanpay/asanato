<?php

namespace App\Containers\BankAccount\Tasks;

use App\Containers\BankAccount\Enum\BankAccountStatus;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * make another bank account default where the default bank
 * account of the user delete
 *
 * Class MakeAnotherBankAccountDefaultTask
 * @package App\Containers\BankAccount\Tasks
 */
class MakeAnotherBankAccountDefaultTask extends Task
{
    public function run(int $currentDefaultAccountId)
    {
        try {
            $query = <<<EOD
UPDATE bank_accounts SET default = TRUE
WHERE id = (SELECT id FROM bank_accounts WHERE id != ? AND status = ? ORDER BY ID DESC LIMIT 1)
EOD;

            DB::update($query, [$currentDefaultAccountId, BankAccountStatus::APPROVED]);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
