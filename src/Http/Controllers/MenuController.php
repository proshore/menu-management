<?php

namespace Proshore\MenuManagement\Http\Controllers;

use Illuminate\Http\Request;
use Proshore\MenuManagement\Models\Menu;
use Proshore\MenuManagement\Models\MenuItem;
use Illuminate\Routing\Controller as BaseController;
use Proshore\MenuManagement\Http\Requests\MenuItemRequest;

class MenuController extends BaseController
{
    /**
     * @var MenuItem
     */
    private $menuItem;

    /**
     * @var Menu
     */
    private $menu;

    /**
     * MenuController constructor.
     *
     * @param MenuItem $menuItem
     * @param Menu     $menu
     */
    public function __construct(MenuItem $menuItem, Menu $menu)
    {
        $this->menu = $menu;
        $this->menuItem = $menuItem;
    }

    /**
     * Display a listing of the menu items.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $menuItems = $this->menuItem->with('menu')->with('page')->select([
            'id',
            'menu_id',
            'menu_item_id',
            'name',
            'type',
            'value',
            'target_group',
            'status',
        ])->get();

        return View('MenuManagement::index', compact('menuItems'));
    }

    /**
     * Display the listing of menu containers.
     *
     * @return \Illuminate\View\View
     */
    public function menuContainers()
    {
        $menuContainers = $this->menu->all();

        return View('MenuManagement::menu-container', compact('menuContainers'));
    }

    /**
     * Display the form for creating menu item.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $menuContainers = $this->menu->all(['name', 'id'])->pluck('name', 'id');
        $menuTypes = $this->menuItem->menuTypeList();
        $menuStatus = $this->menuItem->menuStatusList();
        $menuItems = $this->menuItem->where('menu_item_id', null)->select('id', 'name')->pluck('name', 'id');

        $pageModel = config('proshore-menu-management.cms.model');
        $pageKey = config('proshore-menu-management.cms.key');
        $pageValue = config('proshore-menu-management.cms.value');

        $pages = $pageModel::all([$pageKey, $pageValue])->pluck($pageValue, $pageKey);

        return View('MenuManagement::create',
            compact('menuContainers', 'menuTypes', 'menuStatus', 'menuItems', 'pages'));
    }

    /**
     * Store the newly created menu item.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuItemRequest $request)
    {
        $menuItem = $this->menuItem;
        $menuItem->create($request->all());

        return redirect()->route('menu-item.index');
    }

    /**
     * Display the form for editing the menu item.
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $menuItem = $this->menuItem->findOrFail($id);

        $menuContainers = $this->menu->all(['name', 'id'])->pluck('name', 'id');
        $menuTypes = $this->menuItem->menuTypeList();
        $menuStatus = $this->menuItem->menuStatusList();
        $menuItems = $this->menuItem->where('menu_item_id', null)->select('id', 'name')->pluck('name', 'id');

        $pageModel = config('proshore-menu-management.cms.model');
        $pageKey = config('proshore-menu-management.cms.key');
        $pageValue = config('proshore-menu-management.cms.value');

        $pages = $pageModel::all([$pageKey, $pageValue])->pluck($pageValue, $pageKey);

        return View('MenuManagement::edit',
            compact('menuItem', 'menuContainers', 'menuTypes', 'menuStatus', 'menuItems', 'pages'));
    }

    /**
     * Update the menu item record.
     *
     * @param MenuItemRequest $request
     * @param                 $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuItemRequest $request, $id)
    {
        $menuItem = $this->menuItem->findOrFail($id);

        $menuItem->update($request->all());

        return redirect()->route('menu-item.index');
    }

    /**
     * Remove the menu item record.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $menuItem = $this->menuItem->findOrFail($id);
        $menuItem->delete();

        return redirect()->route('menu-item.index');
    }
}
