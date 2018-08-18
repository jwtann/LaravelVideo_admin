<?php

header('Access-Control-Allow-Origin:*');
//获取轮播图接口路由
Route::get('/getSliders','Api\ApiController@getSliders');
//获取标签接口路由
Route::get('/getTags','Api\ApiController@getTags');
//获取推荐课程路由
Route::get('/getCommendLessons/{num}','Api\ApiController@getCommendLessons');
//获取热门课程路由
Route::get('/getHotLessons/{num}','Api\ApiController@getHotLessons');

//获取所有视频课程路由
Route::get('/getAllLessons','Api\ApiController@getAllLessons');
//获取某个课程数据路由
Route::get('/getLesson/{id}','Api\ApiController@getLesson');
//获取某个课程对应视频数据路由
Route::get('/getVideos/{id}','Api\ApiController@getVideos');

//获取某个标签对应视频数据路由
Route::get('/getTagLessons/{id}','Api\ApiController@getTagLessons');


Route::get('/getHiddenSliders','Api\ApiController@getHiddenSliders');