<?php

namespace Proshore\MenuManagement;

use Proshore\MenuManagement\Models\Menu;
use Proshore\MenuManagement\Models\MenuItem;

/**
 * Class Menu.
 */
class MenuManagement
{
    /**
     * @param $containerName
     *
     * @return array
     */
    public function getMenuByContainer($containerName, $targetGroup = 0)
    {
        if (empty($containerName)) {
            return;
        }
        $menu = Menu::where('slug', $containerName)->select('id')->first();
        if (isset($menu->id)) {
            return MenuItem::where('menu_id', $menu->id)->where('target_group', $targetGroup)->where('status', 1)
                           ->select('menu_id', 'menu_item_id', 'name', 'type', 'value', 'target_group', 'display_order')
                           ->get();
        }
    }
}
