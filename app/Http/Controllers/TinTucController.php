<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LOAITIN;
use App\TINTUC;

class TinTucController extends Controller
{
    //
    public function get()
    {
        $tin_tuc = tintuc::orderBy("id", "DESC")->get();
        return view("admin.tintuc.danhsach", ["list_tin_tuc" => $tin_tuc]);
    }

    public function showUpdatePage($id)
    {
        $list_loai_tin = tintuc::all();
        if ($id != null || $id != "") {
            $tin_tuc = TINTUC::find($id);
            return view("admin.tintuc.sua",
                [
                    "tin_tuc" => $tin_tuc,
                    "list_loai_tin" => $list_loai_tin
                ]
            );
        } else {
            return redirect("admin.tintuc.danhsach");
        }
    }

    public function makeUpdate(Request $req, $id)
    {
        $tin_tuc = tintuc::find($id);
        $this->validate($req,
            [
                "ten_tin_tuc" => "required|unique:tintuc,Ten|min:3|max:100"
            ],
            [
                "ten_tin_tuc.required" => "Bạn chưa nhập tên thể loại",
                "ten_tin_tuc.unique" => "Tên thề loại đã tồn tại",
                "ten_tin_tuc.min" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_tin_tuc.max" => "Tên thể loại chỉ từ 3 đến 100 kí tự"
            ]
        );

        $tin_tuc->Ten = $req->ten_tin_tuc;
        $tin_tuc->TenKhongDau = changeTitle($req->ten_tin_tuc);
        $tin_tuc->idLoaiTin = $req->id_loai_tin;
        $tin_tuc->save();
        return redirect("admin/tintuc/sua/" . $id)->with("thongbao", "Cập nhật thành công");
    }

    public function showAddPage()
    {
        $list_loai_tin = LOAITIN::all();
        return view("admin.tintuc.them", ["list_loai_tin" => $list_loai_tin]);
    }

    public function makeAdd(Request $req)
    {
        $this->validate($req,
            [
                "ten_tin_tuc" => "required|min:3|max:100|unique:tintuc,Ten",
            ],
            [
                "ten_tin_tuc.required" => "Bạn chưa nhập tên thể loại",
                "ten_tin_tuc.min" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_tin_tuc.max" => "Tên thể loại chỉ từ 3 đến 100 kí tự",
                "ten_tin_tuc.unique" => "Tên thể loại đã tồn tại"
            ]
        );
        $tin_tuc = new tintuc();
        $tin_tuc->Ten = $req->ten_tin_tuc;
        $tin_tuc->TenKhongDau = changeTitle($req->ten_tin_tuc);
        $tin_tuc->idLoaiTin = $req->id_loai_tin;
        $tin_tuc->save();
        return redirect("admin/tintuc/them/")->with("thongbao", "Thêm thành công");
    }

    public function makeDelete($id)
    {
        $tin_tuc = tintuc::find("$id");
        $tin_tuc->delete();
        return redirect("admin/tintuc/danhsach")->with("thongbao", "Xóa thành công");
    }
}