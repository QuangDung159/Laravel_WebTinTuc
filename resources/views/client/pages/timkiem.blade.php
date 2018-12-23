@extends("client.layouts.index")
@section("content")
    <?php
    function doiMau($str, $tukhoa)
    {
        return str_replace($tukhoa, "<span style='color:red'>$tukhoa</span>", $str);
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#337AB7; color:white;">
            <h4><b>Từ khóa : {{$tu_khoa}}</b></h4>
        </div>
        @foreach($list_tin_tuc as $tintuc)
            <div class="row-item row">
                <div class="col-md-3">
                    <a href="detail.html">
                        <br>
                        <img width="200px" height="200px" class="img-responsive"
                             src="upload/tintuc/{{$tintuc->Hinh}}"
                             alt="{{$tintuc->TieuDe}}">
                    </a>
                </div>
                <div class="col-md-9">
                    <h3>{!! doiMau($tintuc->TieuDe, $tu_khoa) !!}</h3>
                    <p>{!! doiMau($tintuc->TomTat, $tu_khoa) !!}</p>
                    <a class="btn btn-primary" href="tintuc/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">Chi tiết
                        <span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
                <div class="break"></div>
            </div>
        @endforeach
        {{-- Pagination --}}
        <div class="text-center">
            {{-- {{$tintuc->links()}} --}}
            {{ $list_tin_tuc->appends(Request::all())->links() }}
        </div>
    </div>
@endsection