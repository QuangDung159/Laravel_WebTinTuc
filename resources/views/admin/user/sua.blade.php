@extends("admin.layout.index")
@section("content")
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sửa
                        <small>{{$user->name}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <div class="notification" style="margin-top: 1vh">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $item)
                                    {{$item}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(session("thongbao"))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{session("thongbao")}}
                            </div>
                        @endif
                    </div>
                    <form action="admin/user/sua/{{$user->id}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="ten"
                                   placeholder="Vui lòng nhập tên người dùng..."
                                   value="{{$user->name}}"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email"
                                   disabled=""
                                   value="{{$user->email}}"/>
                        </div>
                        <div class="form-group">
                            <label>Đổi mật khẩu</label>
                            <input type="checkbox" id="doi_mat_khau">
                        </div>
                        <div class="form-group">
                            <div class="notification" style="margin-top: 1vh">
                                @if(session("error_saimatkhau"))
                                    <div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{session("error_saimatkhau")}}
                                    </div>
                                @endif
                            </div>
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" class="form-control password"
                                   name="current_password"
                                   placeholder="Vui lòng nhập mật khẩu..."
                                   disabled=""
                                   id="current_password"/>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" class="form-control password"
                                   name="new_password"
                                   disabled=""
                                   placeholder="Vui lòng nhập mật khẩu..."
                                   id="new_password"/>
                        </div>
                        <div class="form-group">
                            <label>Xác nhận mật khẩu</label>
                            <input type="password" class="form-control password"
                                   name="re_password"
                                   disabled=""
                                   placeholder="Vui lòng nhập mật khẩu..."
                                   id="re_password"/>
                        </div>
                        <div class="form-group">
                            <label>Quyền</label>
                            <label class="radio-inline">
                                <input name="quyen" value="1"
                                       @if($user->quyen == 1)
                                       checked=""
                                       @endif
                                       type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="0" type="radio"
                                       @if($user->quyen == 0)
                                       checked=""
                                        @endif
                                >User
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Xác Nhận</button>
                        <button type="reset" class="btn btn-default">Nhập Lại</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection;

@section("script")
    <script>
        $(document).ready(function () {
            $("#doi_mat_khau").change(function () {
                if ($(this).is(":checked")) {
                    $(".password").removeAttr("disabled");
                } else {
                    $(".password").attr("disabled", "disabled");
                }
            });
        });
    </script>
@endsection