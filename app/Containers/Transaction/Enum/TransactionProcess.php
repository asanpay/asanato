<?php

namespace App\Containers\Transaction\Enum;

class TransactionProcess
{
    // process statuses
    /**
     * not processed
     */
    const NONE = 0;
    /**
     * transaction accomplished and related wallet transaction created successfully
     */
    const ACMP = 1;
    /**
     * transaction refunded and related wallet transactions created successfully
     */
    const RFNP = 2;
}
