@extends("client.layouts.index")
@section("content")
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
                            {{$the_loai->Ten}} |
                            @foreach($the_loai->loaitin as $loai_tin)
                                <small>
                                    <a href="loaitin/{{$loai_tin->id}}/{{$loai_tin->TenKhongDau}}.html"><i>{{$loai_tin->Ten}}</i></a>
                                    |
                                </small>
                            @endforeach
                        </h3>
                        <?php
                        // Lấy list tintuc thỏa where
                        $data = $the_loai->tintuc
                            ->where("NoiBat", 1)
                            ->sortByDesc("created_at")
                            ->take(5);
                        // Lấy phần tử đầu tiên cửa list data
                        $tin1 = $data->shift();
                        ?>
                        <div class="col-md-8 border-right">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tin1->Hinh}}"
                                         alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <h3>{!!$tin1->TieuDe!!}</h3>
                                <p>{!!$tin1->TomTat!!}</p>
                                <a class="btn btn-primary" href="tintuc/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">
                                    Chi tiết
                                    <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                        </div>


                        <div class="col-md-4">
                            @foreach($data as $item)
                                <a href="tintuc/{{$item->id}}/{{$item->TieuDeKhongDau}}.html">
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
    <!-- /.row -->
@endsection