<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class THELOAI extends Model
{
    //
    protected $table = "theloai";

    public function loaitin()
    {
        return $this->hasMany("App\LOAITIN", "idTheLoai", "id");
    }

    /*
     * Lấy ra list tin tức theo idTheLoai từ bảng TheLoai
     */
    public function tintuc()
    {
        // TinTuc -> n_1 -> LoaiTin -> TinTuc.idLoaiTin
        // LoaiTin -> n_1 -> TheLoai -> LoaiTin.idTheLoai
        return $this->hasManyThrough(
            "App\TINTUC",
            "App\LOAITIN",
            "idLoaiTin",
            "idTheLoai",
            "id");
    }
}
