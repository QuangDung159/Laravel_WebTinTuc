@extends("admin.layout.index")
@section("content")
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $item)
                                {{$item}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session("thong_bao"))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session("thong_bao")}}
                        </div>
                    @endif
                    <form action="admin/loaitin/them" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Category Parent</label>
                            <select class="form-control">
                                @foreach($list_the_loai as $item)
                                    <option value="{{$item->id}}">{{$item->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên Loại Tin</label>
                            <input class="form-control" name="ten_loai_tin"
                                   placeholder="Vui lòng nhập tên loại tin..."/>
                        </div>
                        <button type="submit" class="btn btn-default">Xác Nhận</button>
                        <button type="reset" class="btn btn-default">Nhập Lại</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection