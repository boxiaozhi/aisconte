<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
    ], function($api) {
    $api->get('system', 'SystemController@all')->name('api.system.base');
    $api->get('system/{name}', 'SystemController@get')->name('api.system.base');

    $api->get('navs', 'NavController@all')->name('api.nav.all');
    $api->get('navs/labels', 'NavController@getLabels')->name('api.nav.labels');
});

$api->version('v2', function($api) {
    $api->get('version', function() {
        return response('this is version v2');
    });
});
