@extends("client.layouts.index")
@section("content")
    <div class="row carousel-holder">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Thông tin tài khoản</div>
                <div class="panel-body">
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
                    <form method="post" action="user/{{$current_user->id}}">
                        {{csrf_field()}}
                        <div>
                            <label>Họ tên</label>
                            <input type="text" class="form-control" placeholder="Username" name="ten"
                                   aria-describedby="basic-addon1"
                                   value="{{$current_user->name}}">
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                   aria-describedby="basic-addon1"
                                   value="{{$current_user->email}}"
                                   disabled
                            >
                        </div>
                        <br>
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
                        <br>
                        <button type="submit" class="btn btn-default">Sửa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

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