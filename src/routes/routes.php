<?php

$groupParameters['namespace'] = 'Proshore\MenuManagement\Http\Controllers';
if (config('proshore.menu-management.prefix')) {
    $groupParameters['prefix'] = config('proshore.menu-management.prefix');
}
if (config('proshore.menu-management.middleware')) {
    $groupParameters['middleware'] = config('proshore.menu-management.middleware');
}

Route::group($groupParameters, function () {
    Route::get('menu', 'MenuController@menuContainers')->name('menu-container.index');
    Route::resource('menu-item', 'MenuController', ['except' => [
       'show',
    ]]);
    Route::get('menu-item/{id}/reorder', 'MenuController@reorder')->name('menu-item.reorder');
    Route::post('menu-item/ajax-update-menu-order', 'MenuController@updateOrder')->name('menu-item.updateReorder');
});
