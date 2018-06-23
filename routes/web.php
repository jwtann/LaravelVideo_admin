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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::any('/upload','Common\UploadImg@upload');

Route::any('/fileList','Common\UploadImg@fileLists')->name('fileList');

Route::any('/oss','Common\OssController@sign')->name('oss');

include 'admin/admin.php';

include 'api/api.php';