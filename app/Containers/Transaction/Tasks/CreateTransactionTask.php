<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Transaction\Enum\TransactionType;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class CreateTransactionTask extends Task
{

    protected Transaction $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function run(array $data)
    {
        try {
            if (empty($data['merchant_id']) && empty($data['wallet_id'])) {
                throw new CreateResourceFailedException('both merchant and wallet id are empty');
            }
            $transactionType = $data['type'] ?? TransactionType::MERCHANT;

            switch ($transactionType) {
                case TransactionType::MERCHANT:
                    if (!isset($data['merchant_id']) || empty($data['merchant_id'])) {
                        throw new CreateResourceFailedException('merchant_id id is empty');
                    }
                    break;
                case TransactionType::WALLET_TOPUP:
                    if (!isset($data['wallet_id']) || empty($data['wallet_id'])) {
                        throw new CreateResourceFailedException('wallet_id is empty');
                    }
                    break;
            }

            $t = $this->transaction;
            $t->fill($data);

            $t->save();

            return $t;
        } catch (CreateResourceFailedException $e) {
            XLog::exception($e);
            throw $e;
        } catch (Exception $e) {
            XLog::exception($e);
            throw new CreateResourceFailedException();
        }
    }
}
