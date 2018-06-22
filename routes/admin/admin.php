<?php

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function (){
//    首页模板
    Route::get('/','Entry@index')->name('home');
//    登录模板
    Route::get('/login','Login@index')->name('login');
//    验证码
    Route::get('/code','Login@code')->name('code');
//    登录处理
    Route::post('/login','Login@login')->name('login');
//    退出
    Route::get('/logout','Login@logout')->name('logout');

//    用户列表
    Route::resource('/user','AdminControl');

//    密码修改
    Route::get('/password','PasswordController@password')->name('password');
    Route::post('/password','PasswordController@changePwd')->name('password');

//    轮播图
    Route::resource('/slider','SliderController');

//    标签
    Route::resource('/tag','TagController');

//    课程
    Route::resource('/lesson','LessonController');
});