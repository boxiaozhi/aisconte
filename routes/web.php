<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//首页
Route::get('/', 'HomeController@index');

//笔记模块
Route::group(['namespace' => 'Frontend', 'prefix' => 'note'], function(){
    Route::get('/','NoteController@index')->name('note.index');
});

//导航模块
Route::group(['namespace' => 'Frontend', 'prefix' => 'navi'], function(){
    Route::get('/','NaviController@index')->name('navi.index');
});

