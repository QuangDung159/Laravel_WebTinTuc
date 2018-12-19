<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\USER;

class UserController extends Controller
{
    //
    public function get()
    {
        $list_user = USER::all();
        return view("admin.user.danhsach", ["list_user" => $list_user]);
    }

    public function showUpdatePage($id)
    {
        if ($id != null || $id != "") {
            $the_loai = THELOAI::find($id);
            return view("admin.theloai.sua", ["the_loai" => $the_loai]);
        } else {
            return redirect("admin.theloai.danhsach");
        }

    }

    public function makeUpdate(Request $req, $id)
    {
        $the_loai = THELOAI::find($id);
        $this->validate($req,
            [
                "ten_the_loai" => "required|unique:TheLoai,Ten|min:3|max:100"
            ],
            [
                "ten_the_loai.required" => "Bạn chưa nhập tên thể loại",
                "ten_the_loai.unique" => "Tên thề loại đã tồn tại",
                "ten_the_loai.min" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_the_loai.max" => "Tên thể loại chỉ từ 3 đến 100 kí tự"
            ]
        );

        $the_loai->Ten = $req->ten_the_loai;
        $the_loai->TenKhongDau = changeTitle($req->ten_the_loai);
        $the_loai->save();
        return redirect("admin/theloai/sua/" . $id)->with("thongbao", "Cập nhật thành công");
    }

    public function showAddPage()
    {
        return view("admin.user.them");
    }

    public function makeAdd(Request $req)
    {
        $this->validate($req,
            [
                "ten_the_loai" => "required|min:3|max:100|unique:TheLoai,Ten",
            ],
            [
                "ten_the_loai.required" => "Bạn chưa nhập tên thể loại",
                "ten_the_loai.min" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_the_loai.max" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_the_loai.unique" => "Tên thể loại đã tồn tại"
            ]
        );
        $the_loai = new THELOAI();
        $the_loai->Ten = $req->ten_the_loai;
        $the_loai->TenKhongDau = changeTitle($req->ten_the_loai);
        $the_loai->save();
        return redirect("admin/theloai/them/")->with("thong_bao", "Thêm thành công");
    }

    public function makeDelete($id)
    {
        $the_loai = THELOAI::find("$id");
        $list_loai_tin = $the_loai->loaitin;
        if (count($list_loai_tin) > 0) {
            return redirect("admin/theloai/danhsach")
                ->with("khongthanhcong", "Xóa không thành công. Thể loại còn liên kết với loại tin");
        }
        $the_loai->delete();
        return redirect("admin/theloai/danhsach")->with("thongbao", "Xóa thành công");
    }
}
