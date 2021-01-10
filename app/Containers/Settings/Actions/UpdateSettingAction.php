<?php

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class UpdateSettingAction
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class UpdateSettingAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return mixed
     */
    public function run(DataTransporter $data)
    {
        $sanitizedData = $data->sanitizeInput(
            [
            'key',
            'value'
            ]
        );

        $setting = Apiato::call('Settings@UpdateSettingTask', [$data->id, $sanitizedData]);

        return $setting;
    }
}
