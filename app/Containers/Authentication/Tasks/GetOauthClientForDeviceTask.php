<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

/**
 * Class GetOauthClientForDeviceTask
 *
 * @package App\Containers\Authentication\Tasks
 */
class GetOauthClientForDeviceTask extends Task
{

    public function run(string $device): array
    {
        $device = strtolower($device);
        switch ($device) {
            case 'iphone':
            case 'android':
                return [
                    'client_id'       => Config::get('authentication-container.clients.mobile.my.id'),
                    'client_password' => Config::get('authentication-container.clients.mobile.my.secret'),
                ];
                break;
            default:
                return [
                    'client_id'       => Config::get('authentication-container.clients.web.my.id'),
                    'client_password' => Config::get('authentication-container.clients.web.my.secret'),
                ];
                break;
        }
    }
}
