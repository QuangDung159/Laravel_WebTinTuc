<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $user = USER::find($id);
            return view("admin.user.sua", ["user" => $user]);
        } else {
            return redirect("admin.user.danhsach");
        }

    }

    public function makeUpdate(Request $req, $id)
    {
        $user = USER::find($id);
        $this->validate($req,
            [
                "ten" => "required|min:3|max:100",
                "current_password" => "required",
                "new_password" => "required",
                "re_password" => "required|same:new_password"
            ],
            [
                "ten.required" => "Bạn chưa nhập tên",
                "ten.min" => "Tên chỉ từ 3 đến 100 kí tự",
                "ten.max" => "Tên chỉ từ 3 đến 100 kí tự",
                "ten.unique" => "Tên thể loại đã tồn tại",

                "current_password.required" => "Bạn chưa nhập password",
                "new_password.required" => "Bạn chưa nhập password mới",
                "re_password.required" => "Bạn chưa nhập xác nhận password"
            ]
        );
        $user->name = $req->ten;
        $user->quyen = $req->quyen;
        if (Hash::check($req->current_password, $user->password)) {
            $user->password = bcrypt($req->new_password);
        } else {
            return redirect("admin/user/sua/" . $id)->with("error_saimatkhau", "Mật khẩu hiện tại không đúng");
        }
        $user->save();
        return redirect("admin/user/sua/" . $id)->with("thongbao", "Sửa thành công");
    }

    public function showAddPage()
    {
        return view("admin.user.them");
    }

    public function makeAdd(Request $req)
    {
        $this->validate($req,
            [
                "ten" => "required|min:3|max:100",
                "email" => "required|unique:Users,email",
                "password" => "required",
                "re_password" => "required|same:password"
            ],
            [
                "ten.required" => "Bạn chưa nhập tên",
                "ten.min" => "Tên chỉ từ 3 đến 100 kí tự",
                "ten.max" => "Tên chỉ từ 3 đến 100 kí tự",
                "ten.unique" => "Tên thể loại đã tồn tại",

                "email.required" => "Bạn chưa nhập email",
                "email.unique" => "Email đã tồn tại",

                "password.required" => "Bạn chưa nhập password",
                "re_password.required" => "Bạn chưa nhập re-password"
            ]
        );
        $user = new USER();
        $user->name = $req->ten;
        $user->email = $req->email;
        $user->quyen = $req->quyen;
        $user->password = bcrypt($req->password);
        $user->save();
        return redirect("admin/user/them/")->with("thongbao", "Thêm thành công");
    }

    public function makeDelete($id)
    {
        $user = USER::find("$id");
        $list_comment = $user->comment;
        foreach ($list_comment as $item) {
            $item->delete();
        }
        $user->delete();
        return redirect("admin/user/danhsach")->with("thongbao", "Xóa thành công");
    }

    public function showDangNhapAdmin()
    {
        return view("admin.login");
    }

    public function makeDangNhapAdmin(Request $req)
    {
        $this->validate($req,
            [
                "email" => "required",
                "password" => "required",
            ],
            [
                "email.required" => "Bạn chưa nhập email",

                "password.required" => "Bạn chưa nhập password"
            ]
        );
        if (Auth::attempt(["email" => $req->email, "password" => $req->password])) {
            return redirect("admin/theloai/danhsach");
        } else {
            return redirect("admin/dangnhap")->with("error_saithongtindangnhap", "Đăng nhập không thành công");
        }

    }
}
