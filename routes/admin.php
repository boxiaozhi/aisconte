<?php
/* 后台模块 */
Route::group(['prefix' => 'adminc', 'as'=>'admin.'], function(){
    //登录注册
    Route::group(['namespace' => 'Auth', 'middleware' => ['admin.login.check']], function(){
        Route::get('/','LoginController@index')->name('login.index');

        Route::get('/register','RegisterController@index')->name('register.index');
        Route::post('/register','RegisterController@create')->name('register.create');

        Route::get('/login','LoginController@index')->name('login.index');
        Route::post('/login','LoginController@login')->name('login.login');

        Route::get('/logout','LoginController@logout')->name('login.logout');
    });
    //管理
    Route::group(['middleware' => ['admin.auth']], function(){
        //仪表盘
        Route::get('/dashboard','DashboardController@index')->name('dashboard.index');
        //导航
        Route::resource('/navi', 'NaviInfoController', ['parameters' => [
            'naviInfo' => 'id'
        ]]);
        //导航标签
        Route::resource('/naviLabel', 'NaviLabelController', ['parameters' => [
            'naviLabel' => 'id'
        ]]);
    });
});