<?php

namespace App\Containers\BankAccount\Tasks;

use App\Containers\BankAccount\Data\Repositories\BankAccountRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateBankAccountTask extends Task
{

    protected $repository;

    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $id, array $data)
    {
        try {
            // remove default flag from all other user accounts
            if (isset($data['default']) && $data['default'] == true) {
                DB::update('update bank_accounts set "default" = false where user_id = ?', [$data['user_id']]);
            }
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
