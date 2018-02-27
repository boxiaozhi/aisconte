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
Route::group(['namespace' => 'Admin\Controllers'], function() {
});

Route::group(['namespace' => 'Http\Controllers'], function() {
    //hitokoto
	Route::get('hitokoto', 'HomeController@hitokoto');
	//note
    Route::get('note/nav', 'NoteController@nav')->name('note.nav');
    Route::get('note/{id}', 'NoteController@detail')->name('note.detail');
<<<<<<< HEAD
=======
    Route::get('note/testInterface', 'NoteController@testInterface')->name('note.testInterface');
    //system info
    Route::get('systems', 'SystemInfoController@base')->name('systems.base');
>>>>>>> b539cedae56e2099dca32ab16636053a90f88fbc
});
