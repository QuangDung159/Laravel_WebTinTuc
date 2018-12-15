<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\THELOAI;

class TheLoaiController extends Controller
{
    //
    public function get()
    {
        $the_loai = THELOAI::all();
        return view("admin.theloai.danhsach", ["list_the_loai" => $the_loai]);
    }

    public function makeUpdate()
    {

    }

    public function showAddPage()
    {
        return view("admin.theloai.them");
    }

    public function makeAdd(Request $req)
    {
        $this->validate($req,
            [
                "ten_the_loai" => "required|min:3|max:100",
            ],
            [
                "ten_the_loai.required" => "Bạn chưa nhập tên thể loại",
                "ten_the_loai.min" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_the_loai" => "Tên thể loại chỉ từ 3 đến 100 kí tự"
            ]
        );
        $the_loai = new THELOAI();
        $the_loai->Ten = $req->ten_the_loai;
        $the_loai->TenKhongDau = changeTitle($req->ten_the_loai);
        $the_loai->save();
        return redirect("admin/theloai/them/")->with("thong_bao", "Thêm thành công");
    }
}
