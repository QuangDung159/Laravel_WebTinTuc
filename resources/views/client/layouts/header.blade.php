<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="trangchu">Laravel Tin Tức</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Giới thiệu</a>
                </li>
                <li>
                    <a href="lienhe">Liên hệ</a>
                </li>
            </ul>

            <form class="navbar-form navbar-left" role="search"
                  method="get" action="timkiem">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="tu_khoa" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

            <ul class="nav navbar-nav pull-right">
                @if(!isset($current_user))
                    <li>
                        <a href="dangki">Đăng ký</a>
                    </li>
                    <li>
                        <a href="dangnhap">Đăng nhập</a>
                    </li>
                @else
                    <li>
                        <a href="user">
                            <span class="glyphicon glyphicon-user"></span>
                            {{$current_user->name}}
                        </a>
                    </li>
                    <li>
                        <a href="dangxuat">Đăng xuất</a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
