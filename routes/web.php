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

use Illuminate\Support\Facades\Route;

use App\THELOAI;

Route::get('/', function () {
    return view('welcome');
});

Route::group(["prefix" => "admin"], function () {
    Route::group(["prefix" => "theloai"], function () {
        Route::get("danhsach", "TheLoaiController@get");
        Route::get("sua", "TheLoaiController@update");
        Route::get("them", "TheLoaiController@showAddPage");
        Route::post("them", "TheLoaiController@makeAdd");
    });
    Route::group(["prefix" => "loaitin"], function () {
        Route::get("danhsach", "LoaiTinController@get");
        Route::get("sua", "LoaiTinController@update");
        Route::get("them", "LoaiTinController@add");
    });
    Route::group(["prefix" => "user"], function () {
        Route::get("danhsach", "UserController@get");
        Route::get("sua", "UserController@update");
        Route::get("them", "UserController@add");
    });
    Route::group(["prefix" => "tintuc"], function () {
        Route::get("danhsach", "TinTucController@get");
        Route::get("sua", "TinTucController@update");
        Route::get("them", "TinTucController@add");
    });
    Route::group(["prefix" => "slide"], function () {
        Route::get("danhsach", "SlideController@get");
        Route::get("sua", "SlideController@update");
        Route::get("them", "SlideController@add");
    });
});