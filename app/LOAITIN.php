<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LOAITIN extends Model
{
    // theloai -> 1_n -> loaitin
    // loaitin -> 1_n -> tintuc
    protected $table = "loaitin";

    public function theLoai()
    {
        // select theloai.* from theloai, loaitin
        // where theloai.id = loaitin.idTheLoai
        return $this->belongsTo("App\THELOAI",
            "idTheLoai",
            "id");
    }

    public function tinTuc()
    {
        // select tintuc.* from tintuc, loaitin
        // where tintuc.idtintuc = loaitin.id
        return $this->hasMany("App\TINTUC",
            "idLoaiTin",
            "id");
    }
}
