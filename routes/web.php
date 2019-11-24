<?php

Route::group(['middleware' => 'frontend.base'], function(){
    //主页
    Route::group(['namespace' => 'Frontend'], function(){
        //Route::get('/','HomeController@index')->name('index');
        Route::get('/','NoteController@index')->name('note.index');
    });

    //笔记
    Route::group(['namespace' => 'Frontend', 'prefix' => 'note'], function(){
        Route::get('/','NoteController@index')->name('note.index');
    });

    //导航
    Route::group(['namespace' => 'Frontend', 'prefix' => 'nav'], function(){
        Route::get('/','NavController@index')->name('nav.index');
    });

    //时间轴
    Route::group(['namespace' => 'Frontend', 'prefix' => 'timeRecord'], function(){
        Route::get('/','TimeRecordController@index')->name('timeRecord.index');
    });
});