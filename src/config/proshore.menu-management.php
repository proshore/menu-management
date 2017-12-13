<?php

return [
    /*
     * Blade path for main layout Eg: layouts.main
     */
    'layout-extend-path' => 'layouts.layout',
    /*
     * Blade field to put javscript stack. eg stack('scripts')
     */
    'script-stack' => 'scripts',
    /*
     * prefix for the route. leave empty if not required
     */
    'prefix' => 'admin',
    /*
     * Add additional middleware if required
     */
    'middleware' => ['web', 'auth'],
    /*
     * Table class for list view
     */
    'table-class' => 'table table-striped table-hover',
    /*
     * Form class for create and edit menu
     */
    'form-class' => 'menu-item',
    /*
     * Target group: Eg: All, Visitors, Registered Users
     */
    'target-group' => ['All', 'Visitors', 'Registerd Users'],
    /*
     * CMS pages model name
     */
    'cms' => [
        'enabled' => false,
        'model' => 'App\Page',
        'key' => 'id',
        'value' => 'name',
        ],

];
