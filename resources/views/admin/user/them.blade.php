@extends("admin.layout.index")
@section("content")
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="ten"
                                   placeholder="Vui lòng nhập tên người dùng..."/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Vui lòng nhập email..."/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"
                                   placeholder="Vui lòng nhập mật khẩu..."/>
                        </div>
                        <div class="form-group">
                            <label>Re-Password</label>
                            <input type="password" class="form-control" name="re_password"
                                   placeholder="Vui lòng nhập lại mật khẩu..."/>
                        </div>
                        <div class="form-group">
                            <label>Quyền</label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" checked="" type="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="0" type="radio">User
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
@endsection