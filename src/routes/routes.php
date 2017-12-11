<?php

$groupParameters['namespace'] = 'Proshore\MenuManagement\Http\Controllers';
if (config('proshore-menu-management.prefix')) {
    $groupParameters['prefix'] = config('proshore-menu-management.prefix');
}
if (config('proshore-menu-management.middleware')) {
    $groupParameters['middleware'] = config('proshore-menu-management.middleware');
}

Route::group($groupParameters, function () {
    Route::get('menu', 'MenuController@menuContainers');
    Route::resource('menu-item', 'MenuController', ['except' => [
       'show'
    ]]);
});
