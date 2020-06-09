<?php

namespace App\Containers\Transaction\Events\Handlers;

use App\Containers\Transaction\Events\Events\TransactionAccomplished;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class TransactionAccomplishedHandler
 */
class TransactionAccomplishedHandler implements ShouldQueue
{
    public function __construct()
    {

    }

    /**
     * @param \App\Containers\Transaction\Events\Events\TransactionAccomplished $event
     */
    public function handle(TransactionAccomplished $event)
    {
        // do some crazy stuff...
    }
}
