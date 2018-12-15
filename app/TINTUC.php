<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TINTUC extends Model
{
    // loaitin -> 1_n -> tintuc
    // tintuc -> 1_n -> comment
    protected $table = "tintuc";

    public function loaiTin()
    {
        // tintuc thuộc một loaitin
        return $this->belongsTo("App\LOAITIN",
            "idLoaiTin",
            "id");
    }

    public function comment()
    {
        // tintuc có nhiều comment
        return $this->hasMany("App\COMMENT",
            "idTinTuc",
            "id");
    }
}
