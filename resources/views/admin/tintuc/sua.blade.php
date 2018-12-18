@extends("admin.layout.index")
@section("content")
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>{{$tin_tuc->TieuDe}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <div name="notification">
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
                    </div>
                    <form action="admin/tintuc/sua/{{$tin_tuc->id}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Thể Loại</label>
                            <select class="form-control" name="id_the_loai" id="id_the_loai">
                                @foreach($list_the_loai as $item)
                                    <option
                                            @if($tin_tuc->loaiTin->theloai->id == $item->id)
                                            {{"selected"}}
                                            @endif
                                            value="{{$item->id}}">{{$item->Ten}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại Tin</label>
                            <select class="form-control" name="id_loai_tin" id="id_loai_tin">
                                {{-- Nhận data từ ajax --}}
                                @foreach($list_loai_tin as $item)
                                    <option
                                            @if($tin_tuc->loaiTin->id == $item->id)
                                            {{"selected"}}
                                            @endif
                                            value="{{$item->id}}">{{$item->Ten}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu Đề</label>
                            <input class="form-control" name="tieu_de_tin_tuc"
                                   placeholder="Vui lòng nhập tiêu đề tin tức..."
                                   value="{{$tin_tuc->TieuDe}}"/>
                        </div>
                        <div class="form-group">
                            <label>Tóm Tắt</label>
                            <textarea
                                    name="tom_tat" id="demo"
                                    class="form-control ckeditor">
                                {{$tin_tuc->TomTat}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea
                                    name="noi_dung" id="demo"
                                    class="form-control ckeditor">
                                {{$tin_tuc->NoiDung}}
                            </textarea>
                        </div>
                        @if(session("saidinhdang"))
                            <div class="alert alert-danger">
                                {{session("saidinhdang")}}
                            </div>
                        @endif
                        <div class="form-group">
                            {{-- thêm thuộc tính enctype="multipart/form-data" ở <form> --}}
                            <label>Ảnh Hiển Thị</label>
                            <div>
                                <img id="anh" src="upload/tintuc/{{$tin_tuc->Hinh}}" width="100px"
                                     height="100px">
                            </div>
                            <input name="anh_hien_thi" id="anh_hien_thi"
                                   type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nổi Bật</label>
                            <div>
                                <label class="radio-inline">
                                    <input name="noi_bat" value="1"
                                           @if($tin_tuc->NoiBat == 1)
                                           {{'checked=""'}}
                                           @endif
                                           type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="noi_bat" value="0"
                                           @if($tin_tuc->NoiBat == 0)
                                           {{'checked=""'}}
                                           @endif
                                           type="radio">Không
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Xác Nhận</button>
                        <button type="reset" class="btn btn-default">Nhập Lại</button>
                    </form>

                    <div name="notification" style="margin-top: 1vh">
                        @if(session("thongbao_comment"))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{session("thongbao_comment")}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <h1 class="page-header">Bình Luận
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>User</th>
                            <th>Nội Dung</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tin_tuc->comment as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->idUser}}</td>
                                <td>{{$item->NoiDung}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                                            href="admin/tintuc/xoa/{{$item->idTinTuc}}/{{$item->id}}"> Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    {{--<form id="form1" runat="server">--}}
        {{--<input type='file' id="imgInp"/>--}}
        {{--<img id="blah" src="#" alt="your image"/>--}}
    {{--</form>--}}
@endsection

@section("script")
    <script>
        $(document).ready(function () {
            $("#id_the_loai").change(function () {
                var id_the_loai = $(this).val();
                $.get("admin/ajax/loaitin/" + id_the_loai, function (data) {
                    // Thay thế nội dung trong html component có id = "id_loai_tin"
                    // bằng data trả về khi thực thi route ajax/loaitin/{id_the_loai}
                    $("#id_loai_tin").html(data);
                });
            });
        });

        // Script xem ảnh trước khi upload
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#anh').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#anh_hien_thi").change(function () {
            readURL(this);
        });
    </script>
@endsection