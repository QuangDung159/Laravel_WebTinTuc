<?php

namespace App\Http\Controllers;

use App\COMMENT;
use App\LOAITIN;
use App\SLIDE;
use App\TINTUC;
use App\USER;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\THELOAI;
use Illuminate\Support\Facades\Hash;

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

    function checkCurrentUser()
    {
        if (Auth::check()) {
            view()->share("current_user", Auth::user());
        }
    }

    function showTrangChu()
    {
        $this->checkCurrentUser();
        return view("client.pages.trangchu");
    }

    function showLienHe()
    {
        $this->checkCurrentUser();
        return view("client.pages.lienhe");
    }

    private function getSlide()
    {
        return SLIDE::all();
    }

    public function showTinTucByLoaiTin($id)
    {
        $this->checkCurrentUser();
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
        $this->checkCurrentUser();
        $tin_tuc = TINTUC::find($id);
        $list_comment = $tin_tuc->comment;
        $list_tin_lien_quan = TINTUC::where("idLoaiTin", "=", $tin_tuc->idLoaiTin)->take(4)->get();
        $list_tin_noi_bat = TINTUC::where("NoiBat", "=", 1)->take(4)->get();
        return view("client.pages.tintuc",
            [
                "tin_tuc" => $tin_tuc,
                "list_comment" => $list_comment,
                "list_tin_lien_quan" => $list_tin_lien_quan,
                "list_tin_noi_bat" => $list_tin_noi_bat
            ]
        );
    }

    public function showDangNhap()
    {
        $this->checkCurrentUser();
        return view("client.pages.dangnhap");
    }

    public function makeDangNhap(Request $req)
    {
        $this->validate($req,
            [
                "email" => "required|min:3|max:100",
                "password" => "required",
            ],
            [
                "email.required" => "Bạn chưa nhập tên",
                "email.min" => "Tên chỉ từ 3 đến 100 kí tự",
                "email.max" => "Tên chỉ từ 3 đến 100 kí tự",

                "password.required" => "Bạn chưa nhập mật khẩu",
            ]
        );
        if (Auth::attempt(["email" => $req->email, "password" => $req->password])) {
            return redirect("trangchu");
        } else {
            return redirect("dangnhap")->with("error_saithongtindangnhap", "Đăng nhập không thành công");
        }
    }

    public function postComment(Request $req, $idTinTuc, $idUser)
    {
        $this->validate($req,
            [
                "comment" => "required|max:255|min:10"
            ],
            [
                "comment.required" => "Bạn chưa nhập bình luận",
                "comment.max" => "Bình luận phải có độ dài từ 10 đến 255 kí tự",
                "comment.min" => "Bình luận phải có độ dài từ 10 đến 255 kí tự"
            ]
        );
        $comment = new COMMENT();
        $comment->NoiDung = $req->comment;
        $comment->idTinTuc = $idTinTuc;
        $comment->idUser = $idUser;
        $comment->save();
        $tin_tuc = TINTUC::find($idTinTuc);
        return redirect("tintuc/" . $idTinTuc . "/" . $tin_tuc->TieuDeKhongDau . ".html");
    }

    public function makeLogout()
    {
        Auth::logout();
        return redirect("dangnhap");
    }

    public function showUserPage()
    {
        $this->checkCurrentUser();
        return view("client.pages.user");
    }

    public function makeUpdateUser(Request $req, $idUser)
    {
        $user = USER::find($idUser);
        $this->validate($req,
            [
                "ten" => "required|min:3|max:100",
                "current_password" => "required",
                "new_password" => "required",
                "re_password" => "required|same:new_password"
            ],
            [
                "ten.required" => "Bạn chưa nhập tên người dùng",
                "ten.min" => "Tên người dùng chỉ từ 3 đến 100 kí tự",
                "ten.max" => "Tên người dùng chỉ từ 3 đến 100 kí tự",
                "ten.unique" => "Tên người dủng đã tồn tại",

                "current_password.required" => "Bạn chưa nhập password",
                "new_password.required" => "Bạn chưa nhập password mới",
                "re_password.required" => "Bạn chưa nhập xác nhận password"
            ]
        );
        $user->name = $req->ten;
        if (Hash::check($req->current_password, $user->password)) {
            $user->password = bcrypt($req->new_password);
        } else {
            return redirect("user")->with("error_saimatkhau", "Mật khẩu hiện tại không đúng");
        }
        $user->save();
        return redirect("user")->with("thongbao", "Sửa thành công");
    }
}
