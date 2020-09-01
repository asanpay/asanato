<?php

namespace App\Containers\Withdrawal\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class GetUserWithdrawFeeTask extends Task
{

    public function run(User $user)
    {
        //@todo calculate withdraw fee based on the user deal / fee policy
        return Config::get('withdrawal-container.fee');
    }
}
