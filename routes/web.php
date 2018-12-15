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
        Route::get("danhsach", "TheLoaiController@get");
        Route::get("sua/{id}", "TheLoaiController@showUpdatePage");
        Route::post("sua/{id}", "TheLoaiController@makeUpdate");
        Route::get("them", "TheLoaiController@showAddPage");
        Route::post("them", "TheLoaiController@makeAdd");
    });
    Route::group(["prefix" => "user"], function () {
        Route::get("danhsach", "TheLoaiController@get");
        Route::get("sua/{id}", "TheLoaiController@showUpdatePage");
        Route::post("sua/{id}", "TheLoaiController@makeUpdate");
        Route::get("them", "TheLoaiController@showAddPage");
        Route::post("them", "TheLoaiController@makeAdd");
    });
    Route::group(["prefix" => "tintuc"], function () {
        Route::get("danhsach", "TheLoaiController@get");
        Route::get("sua/{id}", "TheLoaiController@showUpdatePage");
        Route::post("sua/{id}", "TheLoaiController@makeUpdate");
        Route::get("them", "TheLoaiController@showAddPage");
        Route::post("them", "TheLoaiController@makeAdd");
    });
    Route::group(["prefix" => "slide"], function () {
        Route::get("danhsach", "TheLoaiController@get");
        Route::get("sua/{id}", "TheLoaiController@showUpdatePage");
        Route::post("sua/{id}", "TheLoaiController@makeUpdate");
        Route::get("them", "TheLoaiController@showAddPage");
        Route::post("them", "TheLoaiController@makeAdd");
    });
});