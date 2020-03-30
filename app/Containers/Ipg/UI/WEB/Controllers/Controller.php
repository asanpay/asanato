<?php

namespace App\Containers\Ipg\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Ipg\UI\WEB\Controllers
 */
class Controller extends WebController
{
    /**
     * Show all entities
     *
     * @param GetAllIpgsRequest $request
     */
    public function index(GetAllIpgsRequest $request)
    {
        $ipgs = Apiato::call('Ipg@GetAllIpgsAction', [$request]);

        // ..
    }
}
