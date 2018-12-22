@extends("client.layouts.index")
@section("content")
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#337AB7; color:white;">
            <h4><b>{{$loai_tin->Ten}}</b></h4>
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
                    <h3>{{$tintuc->TieuDe}}</h3>
                    <p>{{$tintuc->TomTat}}</p>
                    <a class="btn btn-primary" href="detail.html">Chi tiết <span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
                <div class="break"></div>
            </div>
    @endforeach

    <!-- Pagination -->
        <div class="text-center">
            {{$list_tin_tuc->links()}}
        </div>
        <!-- /.row -->
    </div>
@endsection