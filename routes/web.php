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
        Route::get("sua/{id}", "TheLoaiController@showUpdatePage");
        Route::post("sua/{id}", "TheLoaiController@makeUpdate");
        Route::get("them", "TheLoaiController@showAddPage");
        Route::post("them", "TheLoaiController@makeAdd");
        Route::get("xoa/{id}", "TheLoaiController@makeDelete");
    });
    Route::group(["prefix" => "loaitin"], function () {
        Route::get("danhsach", "LoaiTinController@get");
        Route::get("sua/{id}", "LoaiTinController@showUpdatePage");
        Route::post("sua/{id}", "LoaiTinController@makeUpdate");
        Route::get("them", "LoaiTinController@showAddPage");
        Route::post("them", "LoaiTinController@makeAdd");
        Route::get("xoa/{id}", "LoaiTinController@makeDelete");
    });
    Route::group(["prefix" => "tintuc"], function () {
        Route::get("danhsach", "TinTucController@get");
        Route::get("sua/{id}", "TinTucController@showUpdatePage");
        Route::post("sua/{id}", "TinTucController@makeUpdate");
        Route::get("xoa/{idTinTuc}/{idComment}", "TinTucController@deleteComment");
        Route::get("them", "TinTucController@showAddPage");
        Route::post("them", "TinTucController@makeAdd");
        Route::get("xoa/{id}", "TinTucController@makeDelete");
    });
    Route::group(["prefix" => "user"], function () {
        Route::get("danhsach", "UserController@get");
        Route::get("sua/{id}", "UserController@showUpdatePage");
        Route::post("sua/{id}", "UserController@makeUpdate");
        Route::get("them", "UserController@showAddPage");
        Route::post("them", "UserController@makeAdd");
        Route::get("xoa/{id}", "UserController@makeDelete");
    });
    Route::group(["prefix" => "slide"], function () {
        Route::get("danhsach", "SlideController@get");
        Route::get("sua/{id}", "SlideController@showUpdatePage");
        Route::post("sua/{id}", "SlideController@makeUpdate");
        Route::get("them", "SlideController@showAddPage");
        Route::post("them", "SlideController@makeAdd");
        Route::get("xoa/{id}", "SlideController@makeDelete");
    });
    Route::group(["prefix" => "ajax"], function () {
        Route::get("loaitin/{id_the_loai}", "AjaxController@getLoaiTin");
        //Route::post("tintuc/hinh/", "AjaxController@getAnhHienThi");
    });
});

