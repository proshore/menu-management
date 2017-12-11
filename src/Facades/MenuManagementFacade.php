<?php

namespace Proshore\MenuManagement\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MenuManagement
 *
 * @package \Proshore\MenuManagement\Facades
 */
class MenuManagementFacade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'proshore-menu-management';
    }

}
