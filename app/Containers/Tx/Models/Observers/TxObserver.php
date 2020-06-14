<?php

namespace App\Containers\Tx\Models\Observers;


use App\Containers\Tx\Models\Tx;
use App\Ship\Traits\Jalali;

class TxObserver
{
    use Jalali;

    public function creating(Tx $tx)
    {
        // before create ::
        if (empty($tx->j_created_at)) {
            $tx->j_created_at =  static::jalaliTimestamp();
        }
    }

}
