@extends("client.layouts.index")
@section("content")
    <div class="container">
        <!-- slider -->
    @include("client.layouts.slide")
    <!-- end slide -->

        <div class="space20"></div>

        <div class="row main-left">
            @include("client.layouts.menu")
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
                    </div>

                    <div class="panel-body">
                        <!-- item -->
                        @foreach($list_the_loai as $the_loai)
                            @if(count($the_loai->loaitin))
                                <div class="row-item row">
                                    <h3>
                                        <a href="category.html">{{$the_loai->Ten}}</a> |
                                        @foreach($the_loai->loaitin as $loai_tin)
                                            <small><a href="loaitin/{{$loai_tin->id}}"><i>{{$loai_tin->Ten}}</i></a> /</small>
                                        @endforeach
                                    </h3>
                                    <?php
                                    $data = $the_loai->tintuc
                                        ->where("NoiBat", 1)
                                        ->sortByDesc("created_at")
                                        ->take(5);
                                    $tin1 = $data->shift();
                                    ?>
                                    <div class="col-md-8 border-right">
                                        <div class="col-md-5">
                                            <a href="detail.html">
                                                <img class="img-responsive" src="upload/tintuc/{{$tin1->Hinh}}"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="col-md-7">
                                            <h3>{{$tin1->TieuDe}}</h3>
                                            <p>{{$tin1->TomTat}}</p>
                                            <a class="btn btn-primary" href="detail.html">Chi tiết <span
                                                        class="glyphicon glyphicon-chevron-right"></span></a>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        @foreach($data as $item)
                                            <a href="detail.html">
                                                <h4>
                                                    <span class="glyphicon glyphicon-list-alt"></span>
                                                    {{$item->TieuDe}}
                                                </h4>
                                            </a>
                                        @endforeach
                                    </div>

                                    <div class="break"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection