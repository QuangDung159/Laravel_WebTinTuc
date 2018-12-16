@extends("admin.layout.index")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div name="notification" style="margin-top: 1vh">
                    @if(session("khongthanhcong"))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session("khongthanhcong")}}
                        </div>
                    @endif
                    @if(session("thongbao"))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session("thongbao")}}
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>Danh Sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu Đề</th>
                        <th>Tóm Tắt</th>
                        <th>Nổi Bật</th>
                        <th>Lượt Xem</th>
                        <th>Loại Tin</th>
                        <th>Thể Loại</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_tin_tuc as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->TieuDe}}
                                <div>
                                    <img width="100px" height="100px" src="upload/tintuc/{{$item->Hinh}}">
                                </div>
                            </td>
                            <td>{{$item->TomTat}}</td>
                            <td>
                                @if($item->NoiBat == 0)
                                    {{"Không"}}
                                @else
                                    {{"Có"}}
                                @endif
                            </td>
                            <td>{{$item->SoLuotXem}}</td>
                            <td>{{$item->loaitin->Ten}}</td>
                            <td>{{$item->loaitin->theloai->Ten}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection