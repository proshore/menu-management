<?php

namespace Proshore\MenuManagement\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MenuManagement.
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
