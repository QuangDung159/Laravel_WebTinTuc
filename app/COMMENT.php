<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class COMMENT extends Model
{
    //
    protected $table = "comment";

    public function tinTuc()
    {
        // comment thuộc một tintuc
        // tintuc có nhiều comment
        // comment belong to tintuc through idTinTuc
        return $this->belongsTo("App\TINTUC",
            "idTinTuc",
            "id");
    }

    public function user()
    {
        // comment thuộc một user
        // user có nhiều comment
        return $this->belongsTo("App\USER",
            "idUser",
            "id");
    }
}
