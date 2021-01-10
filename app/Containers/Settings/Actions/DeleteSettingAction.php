<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class DeleteSettingAction
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class DeleteSettingAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     */
    public function run(DataTransporter $data): void
    {
        $setting = Apiato::call('Settings@FindSettingByIdTask', [$data->id]);

        Apiato::call('Settings@DeleteSettingTask', [$setting]);
    }
}
