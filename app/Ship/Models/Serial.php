<?php

namespace App\Ship\Models;

use Illuminate\Support\Facades\DB;

class Serial
{
    public static function getNextVal(string $sequence = 'serial'): int
    {
        $nextVal = DB::select(sprintf("SELECT nextval('%s');", $sequence));

        return $nextVal[0]->nextval;
    }
}
