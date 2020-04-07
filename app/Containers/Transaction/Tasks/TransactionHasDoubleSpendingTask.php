<?php

namespace App\Containers\Transaction\Tasks;

use App\Containers\Ipg\UI\WEB\Requests\IpgTransactionCallbackRequest;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\Transaction\Enum\TransactionStatus;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class TransactionHasDoubleSpendingTask extends Task
{
    protected Transaction $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function run(Transaction $transaction, string $referenceId, IpgTransactionCallbackRequest $request): bool
    {
        try {
            // some gateways like melli do not pass reference id via their callback parameters
            if (empty($referenceId)) {
                return false;
            }

            // prevent from using a reference Id for double-spending
            $doubleInvoice = $this->transaction->where('gateway_ref_id', $referenceId)
                ->where('status', '>=', TransactionStatus::VERIFIED)// verified before
                ->where('gateway_id', $transaction->gateway_id)
                ->where('psp_id', $transaction->psp_id)
                ->first();

            if (!empty($doubleInvoice)) {
                // double spending detected
                Xlog::emergency('referenceId double spending detected', [
                    'ref'      => $referenceId,
                    'order_id' => $transaction->gateway_order_id,
                    'ips'      => $request->ips(),
                    'gate'     => $request->psp,
                    $transaction->tagify(),
                ]);
                // mark transaction as double spending
                $transaction->addToJsonb('double_spending', true, false);
                $transaction->addToJsonb('double_spending_to', $doubleInvoice->id, true);

                return true;
            } else {
                // set reference Id of the transaction
                $transaction->setReferenceId($referenceId);

                return false;
            }
        } catch (Exception $exception) {
            throw new InternalErrorException();
        }
    }
}
