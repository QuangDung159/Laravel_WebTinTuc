<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\LOAITIN;
use App\TINTUC;
use App\THELOAI;

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
        $list_the_loai = THELOAI::all();
        return view("admin.tintuc.them",
            [
                "list_loai_tin" => $list_loai_tin,
                "list_the_loai" => $list_the_loai
            ]
        );
    }

    public function makeAdd(Request $req)
    {
        $this->validate($req,
            [
                "tieu_de_tin_tuc" => "required|min:3|max:100|unique:tintuc,TieuDe",
                "id_loai_tin" => "required",
                "tom_tat" => "required",
                "noi_dung" => "required"
            ],
            [
                "tieu_de_tin_tuc.required" => "Bạn chưa nhập tiêu đề",
                "tieu_de_tin_tuc.min" => "Tiêu đề chỉ từ 3 đến 100 kí tự",
                "tieu_de_tin_tuc.max" => "Tiêu đề chỉ từ 3 đến 100 kí tự",
                "tieu_de_tin_tuc.unique" => "Tiêu đề đã tồn tại",

                "id_loai_tin.required" => "Bạn chưa chọn loại tin",

                "tom_tat.required" => "Bạn chưa nhập tóm tắt",

                "noi_dung.required" => "Bạn chưa nhập nội dung"
            ]
        );
        $tin_tuc = new tintuc();
        $tin_tuc->TieuDe = $req->tieu_de_tin_tuc;
        $tin_tuc->TieudeKhongDau = changeTitle($req->tieu_de_tin_tuc);
        $tin_tuc->NoiBat = $req->noi_bat;
        $tin_tuc->SoLuotXem = 0;
        $tin_tuc->idLoaiTin = $req->id_loai_tin;
        $tin_tuc->TomTat = $req->tom_tat;
        $tin_tuc->NoiDung = $req->noi_dung;
        if (isset($req->anh_hien_thi)) {
            $tin_tuc->Hinh = $req->anh_hien_thi;
        } else {
            $tin_tuc->Hinh = "no-image-available.png";
        }
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