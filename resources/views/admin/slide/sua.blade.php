@extends("admin.layout.index")
@section("content")
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Sửa</small>
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
                    @if(session("thongbao"))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session("thongbao")}}
                        </div>
                    @endif
                    <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="ten_hinh"
                                   value="{{$slide->Ten}}"
                                   placeholder="Vui lòng nhập tên hình..."/>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung</label>
                            <input class="form-control" name="noi_dung"
                                   value="{{$slide->NoiDung}}"
                                   placeholder="Vui lòng nhập nội dung..."/>
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" name="link"
                                   value="{{$slide->link}}"
                                   placeholder="Vui lòng nhập link..."/>
                        </div>
                        @if(session("saidinhdang"))
                            <div class="alert alert-danger">
                                {{session("saidinhdang")}}
                            </div>
                        @endif
                        <div class="form-group">
                            {{-- thêm thuộc tính enctype="multipart/form-data" ở <form> --}}
                            <label>Hình</label>
                            <div>
                                <img id="hinh" src="upload/slide/{{$slide->Hinh}}" width="500px">
                            </div>
                            <input name="hinh" id="anh_hien_thi" style="margin-top: 1vh"
                                   type="file" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default">Xác Nhận</button>
                        <button type="reset" class="btn btn-default">Nhập Lại</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection;

@section("script")
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // id thẻ img
                    $('#hinh').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // id the input
        $("#anh_hien_thi").change(function () {
            readURL(this);
        });
    </script>
@endsection