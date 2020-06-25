<?php

namespace App\Ship\Parents\Actions;

use Apiato\Core\Abstracts\Actions\Action as AbstractAction;
use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class Action.
 */
abstract class Action extends AbstractAction
{
    public function weAreOnProduction(): bool
    {
        return app()->environment('production');
    }

    public function weAreOnApiDebug(): bool
    {
        return config('apiato.api.debug', false);
    }

    public function getUser(): User
    {
        return Auth::user();
    }

    public function getUserId(): int
    {
        return $this->getUser()->id;
    }
}
