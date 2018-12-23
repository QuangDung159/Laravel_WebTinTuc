@extends("client.layouts.index")
@section("content")
    <!-- Blog Post Content Column -->
    <div class="col-lg-9">

        <!-- Blog Post -->

        <!-- Title -->
        <h1>{{$tin_tuc->TieuDe}}</h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#">Start Bootstrap</a>
        </p>

        <!-- Preview Image -->
        <img class="img-responsive" src="http://placehold.it/900x300" alt="">

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tin_tuc->created_at}}</p>
        <hr>

        <!-- Post Content -->
        {!!$tin_tuc->NoiDung!!}

        <hr>

        <!-- Blog Comments -->

        <!-- Comments Form -->

        <div class="well">
            <div class="notification">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $item)
                            {{$item}}<br>
                        @endforeach
                    </div>
                @endif
            </div>
            @if(isset($current_user))
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form role="form" method="post"
                      action="postcomment/{{$tin_tuc->id}}/{{$current_user->id}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            @else
                <h4>Bạn cần đăng nhập để đăng bình luận...</h4>
            @endif
        </div>
        <hr>

        <!-- Posted Comments -->
        <!-- Comment -->
        @foreach( $list_comment as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->user->name}}
                        <small>{{$comment->created_at}}</small>
                    </h4>
                    {{$comment->NoiDung}}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-3">
        {{-- Stype to add "..." --}}
        <style>
            .module {
                width: 90%;
                height: 40px;
                overflow: hidden;
                margin-left: auto;
                margin-right: auto;
            }

            .line-clamp {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
            }
        </style>
        <div class="panel panel-default">
            <div class="panel-heading"><b>Tin liên quan</b></div>
            <div class="panel-body">
                @foreach($list_tin_lien_quan as $tin_lien_quan)
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$tin_lien_quan->id}}/{{$tin_lien_quan->TieuDeKhongDau}}.html">
                                <img class="img-responsive" src="upload/tintuc/{{$tin_lien_quan->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <div class="module line-clamp">
                                <a href="tintuc/{{$tin_lien_quan->id}}/{{$tin_lien_quan->TieuDeKhongDau}}.html">
                                    <b>{{$tin_lien_quan->TieuDe}}</b>
                                </a>
                            </div>
                        </div>
                        <div class="module line-clamp">
                            <p>{!!$tin_lien_quan->TomTat!!}</p>
                        </div>
                        <div class="break"></div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><b>Tin nổi bật</b></div>
            <div class="panel-body">
                <!-- item -->
                @foreach($list_tin_noi_bat as $tin_noi_bat)
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$tin_lien_quan->id}}/{{$tin_lien_quan->TieuDeKhongDau}}.html">
                                <img class="img-responsive" src="upload/tintuc/{{$tin_noi_bat->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="tintuc/{{$tin_noi_bat->id}}/{{$tin_noi_bat->TieuDeKhongDau}}.html">
                                <div class="module line-clamp">
                                    <b>{{$tin_noi_bat->TieuDe}}</b>
                                </div>
                            </a>
                        </div>
                        <div class="module line-clamp">
                            <p>{!!$tin_noi_bat->TomTat!!}</p>
                        </div>
                        <div class="break"></div>
                    </div>
                @endforeach
                {{-- End item --}}
            </div>
        </div>

    </div>
@endsection