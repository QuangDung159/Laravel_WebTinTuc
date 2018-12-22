<?php

namespace App\Http\Controllers;

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
}
