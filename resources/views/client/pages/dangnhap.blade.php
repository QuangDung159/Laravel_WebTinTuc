@extends("client.layouts.index")
@section("content")
    <div class="panel panel-default">
        <div class="panel-heading">Đăng nhập</div>
        <div class="panel-body">
            <div class="notification">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $item)
                            {{$item}}<br>
                        @endforeach
                    </div>
                @endif
                @if(session("error_saithongtindangnhap"))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{session("error_saithongtindangnhap")}}
                    </div>
                @endif
            </div>
            <form method="post" action="dangnhap">
                {{csrf_field()}}
                <div>
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Vui lòng nhập email..." name="email">
                </div>
                <br>
                <div>
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" placeholder="Vui lòng nhập mật khẩu..." name="password">
                </div>
                <br>
                <button type="submit" class="btn btn-default">Đăng nhập
                </button>
            </form>
        </div>
    </div>
@endsection