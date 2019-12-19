<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('nav', NavInfoController::class);
    $router->resource('nav-label', NavLabelController::class);
    $router->resource('nav-category', NavCategoryController::class);
});
