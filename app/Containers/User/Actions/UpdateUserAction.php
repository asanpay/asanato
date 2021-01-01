<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Data\Transporters\UserUpdateProfileTransporter;
use App\Containers\User\Enum\UserType;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateUserAction.
 */
class UpdateUserAction extends Action
{

    /**
     * @param UserUpdateProfileTransporter $data
     *
     * @return array
     */
    public function run(UserUpdateProfileTransporter $data): array
    {
        if ($this->getUser()->isProvedMobile()) {
            $data->forget('mobile');
        }

        if ($this->getUser()->isProvedTel()) {
            $data->forget('tel');
        }

        if ($this->getUser()->isProvedEmail()) {
            $data->forget('email');
        }

        if ($this->getUser()->isProvedIdentity()) {
            $data->forget('first_name');
            $data->forget('last_name');
            $data->forget('national_id');
        }

        if ($this->getUser()->isProvedResidency()) {
            if (!empty($this->getUser()->zip)) {
                $data->forget('zip');
            }
            $data->forget('address');
        }

        if ($this->getUser()->isProvedCompany()) {
            $data->forget('company');
            $data->forget('financial_id');
            if ($data->type != UserType::LEGAL) {
                return [null, __('user.change_type_impossible')];
            }
        }

        $userData = $data->toArray();

        // remove null values and their keys
        $userData = array_filter($userData);

        $user = Apiato::call('User@UpdateUserTask', [$userData, $data->id]);

        return [$user, null];
    }
}
