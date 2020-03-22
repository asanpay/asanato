<?php

namespace App\Ship\Parents\Tasks;

use Apiato\Core\Abstracts\Tasks\Task as AbstractTask;

/**
 * Class Task.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Task extends AbstractTask
{
    public function weAreOnProduction()
    {
        return app()->environment('production');
    }
}
