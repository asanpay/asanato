<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Requests\FindUserRequest;
use App\Ship\Parents\Actions\Action;

/**
 * Class FindUserAction.
 */
class FindUserAction extends Action
{

    public function run(string $keyword): ?User
    {
        $keyword = strtolower($keyword);

        if (preg_match('/^0?9\d{9}$/', $keyword)) {
            $keyword = mobilify($keyword);
            return Apiato::call('User@FindUserByMobileTask', [$keyword]);
        } else if (filter_var($keyword, FILTER_VALIDATE_EMAIL)) {
            return Apiato::call('User@FindUserByEmailTask', [$keyword]);
        }
        return null;
    }
}
