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
        if ($id != null || $id != "") {
            $slide = SLIDE::find($id);
            return view("admin.slide.sua",
                [
                    "slide" => $slide
                ]
            );
        } else {
            return redirect("admin.slide.danhsach");
        }
    }

    public function makeUpdate(Request $req, $id)
    {
        $slide = SLIDE::find($id);
        $this->validate($req,
            [
                "ten_hinh" => "required|min:3|max:100",
                "noi_dung" => "required|min:3|max:255",
                "link" => "required|min:3|max:255"
            ],
            [
                "ten_hinh.required" => "Bạn chưa nhập tên hình",
                "ten_hinh.min" => "Tên hình chỉ từ 3 đến 100 kí tự",
                "ten_hinh.max" => "Tên hình chỉ từ 3 đến 100 kí tự",

                "noi_dung.required" => "Bạn chưa nhập nội dung",
                "noi_dung.min" => "Nội dung phải chứa từ 3 đến 255 kí tự",
                "noi_dung.max" => "Nội dung phải chứa từ 3 đến 255 kí tự",

                "link.required" => "Bạn chưa nhập link",
                "link.max" => "Link phải chứa từ 3 đến 255 kí tự",
                "link.min" => "Link phải chứa từ 3 đến 255 kí tự"
            ]
        );

        $slide->Ten = $req->ten_hinh;
        $slide->NoiDung = $req->noi_dung;
        $slide->link = $req->link;

        if ($req->hasFile("hinh")) {
            $file = $req->file("hinh");
            $fileExt = $file->getClientOriginalExtension();
            if ($fileExt != "jpeg" and $fileExt != "jpg" and $fileExt != "png") {
                return redirect("admin/slide/sua/" . $id)->with("saidinhdang", "Chỉ nhận định dạng jpeg, png, jpg");
            } else {
                $fileName = $file->getClientOriginalName();
                $fileNameToSave = str_random(10) . $fileName;
                while (file_exists("upload/slide/" . $fileNameToSave)) {
                    $fileNameToSave = str_random(10) . $fileName;
                }
                unlink("upload/slide/" . $slide->Hinh);
                $file->move("upload/slide", $fileNameToSave);
                $slide->Hinh = $fileNameToSave;
            }
        }
        $slide->save();
        return redirect("admin/slide/sua/" . $id)->with("thongbao", "Sửa thành công");
    }

    public function showAddPage()
    {
        return view("admin.slide.them");
    }

    public function makeAdd(Request $req)
    {
        $this->validate($req,
            [
                "ten_hinh" => "required|min:3|max:100|unique:Slide,Ten",
                "noi_dung" => "required|min:3|max:255",
                "link" => "required|min:3|max:255"
            ],
            [
                "ten_hinh.required" => "Bạn chưa nhập tên hình",
                "ten_hinh.min" => "Tên hình chỉ từ 3 đến 100 kí tự",
                "ten_hinh.max" => "Tên hình chỉ từ 3 đến 100 kí tự",
                "ten_hinh.unique" => "Tên hình đã tồn tại",

                "noi_dung.required" => "Bạn chưa nhập nội dung",
                "noi_dung.min" => "Nội dung phải chứa từ 3 đến 255 kí tự",
                "noi_dung.max" => "Nội dung phải chứa từ 3 đến 255 kí tự",

                "link.required" => "Bạn chưa nhập link",
                "link.max" => "Link phải chứa từ 3 đến 255 kí tự",
                "link.min" => "Link phải chứa từ 3 đến 255 kí tự"
            ]
        );
        $slide = new SLIDE();
        $slide->Ten = $req->ten_hinh;
        $slide->NoiDung = $req->noi_dung;
        $slide->link = $req->link;

        if ($req->hasFile("hinh")) {
            $file = $req->file("hinh");
            $fileExt = $file->getClientOriginalExtension();
            if ($fileExt != "jpeg" and $fileExt != "jpg" and $fileExt != "png") {
                return redirect("admin/slide/them")->with("saidinhdang", "Chỉ nhận định dạng jpeg, png, jpg");
            } else {
                $fileName = $file->getClientOriginalName();
                $fileNameToSave = str_random(10) . $fileName;
                while (file_exists("upload/slide/" . $fileNameToSave)) {
                    $fileNameToSave = str_random(10) . $fileName;
                }
                $file->move("upload/slide", $fileNameToSave);
                $slide->Hinh = $fileNameToSave;
            }
        } else {
            $slide->Hinh = "related_post_no_available_image.png";
        }
        $slide->save();
        return redirect("admin/slide/them/")->with("thongbao", "Thêm thành công");
    }

    public function makeDelete($id)
    {
        $slide = SLIDE::find("$id");
        $slide->delete();
        unlink("upload/slide/" . $slide->Hinh);
        return redirect("admin/slide/danhsach")->with("thongbao", "Xóa thành công");
    }
}
