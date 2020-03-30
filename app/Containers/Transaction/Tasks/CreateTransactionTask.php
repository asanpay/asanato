<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Transaction\Models\Transaction;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

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
            $t                 = $this->transaction;
            $t->user_id        = $data['user_id'];
            $t->merchant_id    = $data['merchant_id'];
            $t->amount         = $data['amount'];
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
        }
        catch (Exception $exception) {
            dd($exception->getMessage());
            throw new CreateResourceFailedException();
        }
    }
}
