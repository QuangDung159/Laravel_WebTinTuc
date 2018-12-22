<?php

namespace App\Http\Controllers;

use App\COMMENT;
use App\LOAITIN;
use App\SLIDE;
use App\TINTUC;
use Illuminate\Http\Request;
use App\THELOAI;

class PageController extends Controller
{
    //

    function __construct()
    {
        $list_the_loai = THELOAI::all();
        $list_slide = $this->getSlide();
        view()->share("list_the_loai", $list_the_loai);
        view()->share("list_slide", $list_slide);
    }

    function showTrangChu()
    {
        return view("client.pages.trangchu");
    }

    function showLienHe()
    {
        return view("client.pages.lienhe");
    }

    private function getSlide()
    {
        return SLIDE::all();
    }

    public function showTinTucByLoaiTin($id)
    {
        $loai_tin = LOAITIN::find($id);
        $list_tin_tuc = TINTUC::where("idLoaiTin", $id)->paginate(5);
        return view("client.pages.loaitin",
            [
                "list_tin_tuc" => $list_tin_tuc,
                "loai_tin" => $loai_tin
            ]
        );
    }

    public function showTinTucChiTiet($id)
    {
        $tin_tuc = TINTUC::find($id);
        $list_comment = COMMENT::where("idTinTuc", $id);
        return view("client.pages.tintuc",
            [
                "tin_tuc" => $tin_tuc,
                "list_comment" => $list_comment
            ]
        );
    }
}
