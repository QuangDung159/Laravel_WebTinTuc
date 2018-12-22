<?php

namespace App\Http\Controllers;

use App\LOAITIN;
use App\SLIDE;
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
        $list_tin_tuc = $loai_tin->tintuc->take(5);
        return view("client.pages.loaitin", ["list_tin_tuc" => $list_tin_tuc]);
    }
}
