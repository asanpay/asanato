<?php

namespace App\Containers\Site\UI\WEB\Controllers;

use App\Containers\Site\UI\WEB\Requests\CreateSiteRequest;
use App\Containers\Site\UI\WEB\Requests\DeleteSiteRequest;
use App\Containers\Site\UI\WEB\Requests\GetAllSitesRequest;
use App\Containers\Site\UI\WEB\Requests\FindSiteByIdRequest;
use App\Containers\Site\UI\WEB\Requests\UpdateSiteRequest;
use App\Containers\Site\UI\WEB\Requests\StoreSiteRequest;
use App\Containers\Site\UI\WEB\Requests\EditSiteRequest;
use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Site\UI\WEB\Controllers
 */
class Controller extends WebController
{
    /**
     * @return  string
     */
    public function homepage()
    {
        // No actions to call. Since there's nothing to do but returning a response.

        return view('site::homepage');
    }
}
