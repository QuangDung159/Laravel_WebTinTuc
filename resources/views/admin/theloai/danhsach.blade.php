@extends("admin.layout.index")
@section("content")
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                @if(session("thongbao"))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{session("thongbao")}}
                    </div>
                @endif
                <div class="col-lg-12">
                    <h1 class="page-header">Thể loại
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Tên không dấu</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_the_loai as $item)
                        <tr class="even gradeC" align="center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->Ten}}</td>
                            <td>{{$item->TenKhongDau}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                                        href="admin/theloai/xoa/{{$item->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                        href="admin/theloai/sua/{{$item->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection