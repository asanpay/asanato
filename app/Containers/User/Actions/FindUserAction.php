<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;

/**
 * Class FindUserAction.
 */
class FindUserAction extends Action
{

    public function run(string $keyword): ?User
    {
        //@todo prevent throttle to fetching all user data
        $keyword = strtolower($keyword);

        if (preg_match(config('regex.mobile_regex'), $keyword)) {
            $keyword = mobilify($keyword);
            return Apiato::call('User@FindUserByMobileTask', [$keyword]);
        } else if (filter_var($keyword, FILTER_VALIDATE_EMAIL)) {
            return Apiato::call('User@FindUserByEmailTask', [$keyword]);
        }
        return null;
    }
}
