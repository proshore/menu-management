# menu-management
[![Latest Stable Version](https://poser.pugx.org/proshore/email-templates/v/stable)](https://packagist.org/packages/proshore/email-templates)
[![Total Downloads](https://poser.pugx.org/proshore/email-templates/downloads)](https://packagist.org/packages/proshore/email-templates)
[![Latest Unstable Version](https://poser.pugx.org/proshore/email-templates/v/unstable)](https://packagist.org/packages/proshore/email-templates)
[![License](https://poser.pugx.org/proshore/email-templates/license)](https://packagist.org/packages/proshore/email-templates)
[![StyleCI](https://styleci.io/repos/113825495/shield?branch=master)](https://styleci.io/repos/113825495)

A database based Menu managment with Bootstrap for Laravel 5.5

This package will create a menu management module in your backend. The menu management can be used to dynamically store menu in the database and can be used in front end. There are three types of menu present: Internal Menu, External menu and CMS pages menu.

This package is solely prepare to help build database based menu management and may have some unknown glitches. Please report issues if you find one.

## Installation
1. Require this package with composer.

```shell
composer require proshore/menu-management
```

Laravel 5.5 uses Package Auto-Discovery, so you don't have to manually add the package to the ServiceProvider.

2. Publish the config file. 

3. Run migration
````Shell
php artisan migrate
````
4. Create a seed file for menu. THe seed file should create a container for menu table. THey may be header, footer.

## Terms
- Menu: The main container of menu where all menu items are listed
- MenuItem: the actual menu inside the container
- Status: Active/Inactive
- Target Group: Defining which menu shoudl be visible for which users
- Type: Different type of menu. Internal menu, External Link, CMS pages
- Parent: Defining the parent menu

## Publishing
#### Publishing the config file
````shell
php artisan vendor:publish --tag=config
````

#### Publishing views
If you want to override your view then please run the following command and make necessary changes
````shell
php artisan vendor:publish --tag=views
````

## Documentation
To change the main layout path. Select your backend default layout
````javascript
'layout-extend-path' => 'layouts.layout'
````
Default stack to push your javascript file
````javascript
'script-stack' => 'scripts',
````

Prefix of your backend section. Leave empty if there is no prefix.
````javascript
'prefix' => 'admin',
````

If you need to use extra middleware, append middleware in the following configuration
````javascript
'middleware' => ['web', 'auth'],
````

The bootstrap class for table view and form view
````javascript
'table-class' => 'table table-striped table-hover',
'form-class' => 'menu-item',
````

The target group for which you want to create menu. These are basically the role in the frontend. Based upon this array, you need to create a logic in frontend for displaying the menu. In below example, the 0 => All, 1 => Visitors and 2 => Registered user. Use this key in the facade for targetgroup.
````javascript
 'target-group' => ['All', 'Visitors', 'Registerd Users'],
````

In order to have CMS pages link to menu, please add the full namespace model name, the primary key of the table and name of the page to display in drodown. Make sure the cms page table has slug field as well.

````javascript
'cms' => [
        'model' => 'App\Page',
        'key' => 'id',
        'value' => 'name',
        ],
````


To pull the menu array in frontend, use the available facade. ContainerName is the name of the menu container and targetgroup is the key of the role. 
````php
MenuManagement::getMenuByContainer($containerName, $targetGroup)
````


## Contributor
Babish Shrestha
