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

    public function run(array $data, array $jsonb)
    {
        try {
            if (empty($data['merchant_id']) && empty($data['wallet_id'])) {
                throw new CreateResourceFailedException('both merchant and wallet id are empty');
            }
            $transactionType = $data['type'] ?? TransactionType::MERCHANT;

            switch ($transactionType) {
                case TransactionType::MERCHANT:
                {
                    if (!isset($data['merchant_id']) || empty($data['merchant_id'])) {
                        throw new CreateResourceFailedException('merchant_id id is empty');
                    }
                    break;
                }
                case TransactionType::WALLET_TOPUP:
                {
                    if (!isset($data['wallet_id']) || empty($data['wallet_id'])) {
                        throw new CreateResourceFailedException('wallet_id is empty');
                    }
                    break;
                }
            }

            $t                 = $this->transaction;
            $t->type           = $transactionType;
            $t->user_id        = $data['user_id'];
            $t->merchant_id    = $data['merchant_id'] ?? null;
            $t->wallet_id      = $data['wallet_id'] ?? null;
            $t->amount         = currency($data['amount']);
            $t->payable_amount = $data['payable_amount'];
            $t->merchant_share = $data['merchant_share'];
            $t->callback_url   = $data['callback_url'];
            $t->invoice_number = $data['invoice_number'];
            $t->description    = $data['description'];
            $t->payer_name     = $data['payer_name'];
            $t->payer_email    = $data['payer_email'];
            $t->payer_mobile   = $data['payer_mobile'];

            // add json
            $t->setJsonb($jsonb, false);

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
