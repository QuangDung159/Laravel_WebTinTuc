<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\THELOAI;
use App\LOAITIN;

class AjaxController extends Controller
{
    //
    public function getLoaiTin($id_the_loai)
    {
//        $the_loai = THELOAI::find($id_the_loai);
//        $list_loai_tin = $the_loai->loaitin;
        $loai_tin = LOAITIN::where("idTheLoai", $id_the_loai)->get();
        foreach ($loai_tin as $item) {
            echo '<option value="' . $item->id . '">' . $item->Ten . '</option>';
        }
    }

//    public function getAnhHienThi($anh_hien_thi)
//    {
//        echo '<img id="anh" src="' . $anh_hien_thi . '" width="100px"
//                                     height="100px">';
//    }
}
