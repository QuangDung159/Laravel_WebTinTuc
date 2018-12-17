<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\LOAITIN;
use App\TINTUC;
use App\THELOAI;
use App\COMMENT;

class TinTucController extends Controller
{
    //
    public function get()
    {
        $tin_tuc = TINTUC::orderBy("id", "DESC")->get();
        return view("admin.tintuc.danhsach", ["list_tin_tuc" => $tin_tuc]);
    }

    public function showUpdatePage($id)
    {
        if ($id != null || $id != "") {
            $list_loai_tin = LOAITIN::all();
            $list_the_loai = THELOAI::all();
            $tin_tuc = TINTUC::find($id);
            return view("admin.tintuc.sua",
                [
                    "tin_tuc" => $tin_tuc,
                    "list_the_loai" => $list_the_loai,
                    "list_loai_tin" => $list_loai_tin,
                ]
            );
        } else {
            return redirect("admin/tintuc/danhsach");
        }
    }

    public function makeUpdate(Request $req, $id)
    {
        if ($id != null || $id != "") {
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
            $tin_tuc = TINTUC::find($id);
            $tin_tuc->TieuDe = $req->tieu_de_tin_tuc;
            $tin_tuc->TieudeKhongDau = changeTitle($req->tieu_de_tin_tuc);
            $tin_tuc->NoiBat = $req->noi_bat;
            $tin_tuc->SoLuotXem = 0;
            $tin_tuc->idLoaiTin = $req->id_loai_tin;
            $tin_tuc->TomTat = $req->tom_tat;
            $tin_tuc->NoiDung = $req->noi_dung;
            if ($req->hasFile("anh_hien_thi")) {
                $tin_tuc->Hinh = $req->anh_hien_thi;
                $file = $req->file("anh_hien_thi");
                $extension = $file->getClientOriginalExtension();
                if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
                    return redirect("admin/tintuc/them")
                        ->with("saidinhdang", "Sai định dạng, định dạng đúng : jpg, jpeg, png");
                }
                $file_name = $file->getClientOriginalName();
                $hinh = str_random(10) . "_" . $file_name;
                while (file_exists("upload/tintuc/" . $hinh)) {
                    $hinh = str_random("10" . "_" . $file_name);
                }
                $file->move("upload/tintuc", $hinh);
                unlink("upload/tintuc/" . $tin_tuc->Hinh);
                $tin_tuc->Hinh = $hinh;
            }
            $tin_tuc->save();
            return redirect("admin/tintuc/sua/" . $id)->with("thongbao", "Thêm thành công");
        } else {
            return redirect("admin/tintuc/danhsach");
        }
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
        if ($req->hasFile("anh_hien_thi")) {
            $tin_tuc->Hinh = $req->anh_hien_thi;
            $file = $req->file("anh_hien_thi");
            $extension = $file->getClientOriginalExtension();
            if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
                return redirect("admin/tintuc/them")
                    ->with("saidinhdang", "Sai định dạng, định dạng đúng : jpg, jpeg, png");
            }
            $file_name = $file->getClientOriginalName();
            $hinh = str_random(10) . "_" . $file_name;
            while (file_exists("upload/tintuc/" . $hinh)) {
                $hinh = str_random("10" . "_" . $file_name);
            }
            $file->move("upload/tintuc", $hinh);
            $tin_tuc->Hinh = $hinh;
        } else {
            $tin_tuc->Hinh = "no-image-available.png";
        }
        $tin_tuc->save();
        return redirect("admin/tintuc/them/")->with("thongbao", "Thêm thành công");
    }

    public function makeDelete($id)
    {
        $tin_tuc = TINTUC::find("$id");
        $tin_tuc->delete();
        return redirect("admin/tintuc/danhsach")->with("thongbao", "Xóa thành công");
    }

    public function deleteComment($idTinTuc, $idComment)
    {
        $comment = COMMENT::find($idComment);
        $comment->delete();
        return redirect("admin/tintuc/sua/" . $idTinTuc)->with("thongbao_comment", "Xóa thành công");
    }
}