<?php

namespace App\Ship\Parents\Actions;

use Apiato\Core\Abstracts\Actions\Action as AbstractAction;

/**
 * Class Action.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
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
}
