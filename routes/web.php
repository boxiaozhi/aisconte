<?php

Route::group(['middleware' => 'frontend.base'], function(){
    //主页
    Route::group(['namespace' => 'Frontend'], function(){
        Route::get('/','HomeController@index')->name('index');
    });

    //笔记模块
    Route::group(['namespace' => 'Frontend', 'prefix' => 'note'], function(){
        Route::get('/','NoteController@index')->name('note.index');
    });

    //导航模块
    Route::group(['namespace' => 'Frontend', 'prefix' => 'navi'], function(){
        Route::get('/','NaviController@index')->name('navi.index');
    });
});