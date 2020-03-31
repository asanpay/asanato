<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Transaction\Models\Transaction;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindTransactionByPublicTokenTask extends Task
{
    protected Transaction $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function run($token, array $with = ['psp', 'gateway', 'merchant']): ?Transaction
    {
        try {
            return $this->transaction->findByPublicToken($token, $with);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
