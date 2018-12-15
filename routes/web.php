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

Route::get("thu", function () {
    $the_loai = THELOAI::find(1);
    foreach ($the_loai->loaitin as $item_loaitin) {
        echo $item_loaitin->Ten . "</br>";
    }
});

