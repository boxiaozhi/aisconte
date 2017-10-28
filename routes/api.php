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

Route::middleware('auth:api')->namespace('Http\Controllers')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Admin\Controllers'],function(){
	Route::get('wizNotes/actions/navList', 'WizNoteController@navList');
	Route::get('wizNotes/actions/note/{id}', 'WizNoteController@getNote');
});