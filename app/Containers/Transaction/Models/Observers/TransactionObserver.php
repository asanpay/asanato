<?php

namespace App\Containers\Transaction\Models\Observers;

use App\Containers\Transaction\Enum\TransactionStatus;
use App\Containers\Transaction\Events\Events\TransactionAccomplished;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Traits\Jalali;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;
use Tartan\Zaman\Facades\Zaman;

class TransactionObserver
{
    use Jalali;

    public function saving(Transaction $transaction)
    {
        //XLog::debug('transaction observer --> saving', [$transaction->tagify()]);
    }

    public function creating(Transaction $transaction)
    {
        XLog::debug('transaction observer --> creating');
        // before save ::
        if (!isset($transaction->j_created_at) || empty($transaction->j_created_at)) {
            $transaction->j_created_at =  static::jalaliTimestamp();
        }
        if (!isset($transaction->flag) || empty($transaction->flag)) {
            $transaction->flag = transaction_flag();
        }
    }

    /**
     * Listen to the Transaction created event.
     *
     * @param Transaction $transaction
     *
     * @return void
     */
    public function created(Transaction $transaction)
    {
        XLog::debug('transaction observer --> created', [$transaction->tagify()]);

        // if transaction created in accomplished state
        if ($transaction->status === TransactionStatus::ACCOMPLISHED) {
            XLog::debug('transaction accomplished');
            event(new TransactionAccomplished($transaction));
        }
    }

    /**
     * Listen to the Transaction updating event.
     *
     * @param Transaction $transaction
     *
     * @return void
     */
    public function updating(Transaction $transaction)
    {
        XLog::debug('transaction observer --> updating id:' . $transaction->id, [$transaction->tagify()]);
        if ($transaction->isDirty('accomplished_at')) {
            $transaction->j_accomplished_at = static::jalaliTimestamp();
        }

        if ($transaction->isDirty('status')) {
            switch($transaction->status) {
                case TransactionStatus::ACCOMPLISHED: {
                    $transaction->accomplished_at = DB::raw('NOW()');
                    $transaction->j_accomplished_at = static::jalaliTimestamp();
                    break;
                }
                case TransactionStatus::REFUNDED: {
                    $transaction->refunded_at = DB::raw('NOW()');
                    break;
                }
            }
        }
    }

    public function updated(Transaction $transaction)
    {
        XLog::debug('transaction observer --> updated', ['tag' => $transaction->tagify()]);

        // if transaction accomplished status changed from another state (not accomplished before)
        if ($transaction->status == TransactionStatus::ACCOMPLISHED && $transaction->getOriginal('status') != TransactionStatus::ACCOMPLISHED) {
            XLog::debug('transaction accomplished');
            event(new TransactionAccomplished($transaction));
        }
    }

    public function saved(Transaction $transaction)
    {
        XLog::debug('transaction observer --> saved', ['tag' => $transaction->tagify()]);
    }
}
