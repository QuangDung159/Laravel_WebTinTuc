@extends("client.layouts.index")
@section("content")
    <div class="row carousel-holder">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Đăng ký tài khoản</div>
                <div class="panel-body">
                    <div class="notification" style="margin-top: 1vh">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $item)
                                    {{$item}}<br>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <form action="dangki" method="post">
                        {{csrf_field()}}
                        <div>
                            <label>Họ tên</label>
                            <input type="text" class="form-control" placeholder="Username" name="ten"
                                   aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                   aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>Nhập mật khẩu</label>
                            <input type="password" class="form-control" name="password"
                                   aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="re_password"
                                   aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection