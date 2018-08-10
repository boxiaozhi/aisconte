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
Route::get('/', function () {
    return redirect(route('note.index'));
});

//笔记模块
Route::group(['namespace' => 'Note'], function(){
    Route::get('/note','NoteController@index')->name('note.index');
});
