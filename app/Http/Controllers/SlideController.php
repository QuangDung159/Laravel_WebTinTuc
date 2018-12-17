<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SLIDE;

class SlideController extends Controller
{
    //
    public function get()
    {
        $list_slide = SLIDE::all();
        return view("admin.slide.danhsach", ["list_slide" => $list_slide]);
    }

    public function showUpdatePage($id)
    {
        $list_the_loai = THELOAI::all();
        if ($id != null || $id != "") {
            $loai_tin = LOAITIN::find($id);
            return view("admin.loaitin.sua",
                [
                    "loai_tin" => $loai_tin,
                    "list_the_loai" => $list_the_loai
                ]
            );
        } else {
            return redirect("admin.loaitin.danhsach");
        }
    }

    public function makeUpdate(Request $req, $id)
    {
        $loai_tin = LOAITIN::find($id);
        $this->validate($req,
            [
                "ten_loai_tin" => "required|unique:LoaiTin,Ten|min:3|max:100"
            ],
            [
                "ten_loai_tin.required" => "Bạn chưa nhập tên thể loại",
                "ten_loai_tin.unique" => "Tên thề loại đã tồn tại",
                "ten_loai_tin.min" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_loai_tin.max" => "Tên thể loại chỉ từ 3 đến 100 kí tự"
            ]
        );

        $loai_tin->Ten = $req->ten_loai_tin;
        $loai_tin->TenKhongDau = changeTitle($req->ten_loai_tin);
        $loai_tin->idTheLoai = $req->id_the_loai;
        $loai_tin->save();
        return redirect("admin/loaitin/sua/" . $id)->with("thongbao", "Cập nhật thành công");
    }

    public function showAddPage()
    {
        return view("admin.slide.them");
    }

    public function makeAdd(Request $req)
    {
        $this->validate($req,
            [
                "ten_loai_tin" => "required|min:3|max:100|unique:LoaiTin,Ten",
            ],
            [
                "ten_loai_tin.required" => "Bạn chưa nhập tên thể loại",
                "ten_loai_tin.min" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_loai_tin.max" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_loai_tin.unique" => "Tên thể loại đã tồn tại"
            ]
        );
        $loai_tin = new LOAITIN();
        $loai_tin->Ten = $req->ten_loai_tin;
        $loai_tin->TenKhongDau = changeTitle($req->ten_loai_tin);
        $loai_tin->idTheLoai = $req->id_the_loai;
        $loai_tin->save();
        return redirect("admin/loaitin/them/")->with("thong_bao", "Thêm thành công");
    }

    public function makeDelete($id)
    {
        $loai_tin = LOAITIN::find("$id");
        $list_tin_tuc = $loai_tin->tinTuc;
        if (count($list_tin_tuc) > 0) {
            return redirect("admin/loaitin/danhsach")
                ->with("khongthanhcong", "Xóa không thành công. Loại tin còn liên kết với tin tức");
        }
        $loai_tin->delete();
        return redirect("admin/loaitin/danhsach")->with("thongbao", "Xóa thành công");
    }
}
