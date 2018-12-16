@extends("admin.layout.index")
@section("content")
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Thể Loại</label>
                            <select class="form-control" name="id_the_loai" id="id_the_loai">
                                @foreach($list_the_loai as $item)
                                    <option value="{{$item->id}}">{{$item->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại Tin</label>
                            <select class="form-control" name="id_loai_tin" id="id_loai_tin">
                                {{-- Nhận data từ ajax --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu Đề</label>
                            <input class="form-control" name="tieu_de_tin_tuc"
                                   placeholder="Vui lòng nhập tiêu đề tin tức..."/>
                        </div>
                        <div class="form-group">
                            <label>Tóm Tắt</label>
                            <textarea
                                    name="tom_tat"
                                    id="demo"
                                    class="form-control ckeditor">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea
                                    name="noi_dung"
                                    id="demo"
                                    class="form-control ckeditor">
                            </textarea>
                        </div>
                        <div class="form-group">
                            {{-- thêm thuộc tính enctype="multipart/form-data" ở <form> --}}
                            <label>Ảnh Hiển Thị</label>
                            <input name="anh_hien_thi" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nổi Bật</label>
                            <div>
                                <label class="radio-inline">
                                    <input name="noi_bat" value="1" checked="" type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="noi_bat" value="0" type="radio">Không
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">xác Nhận</button>
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
    </script>
@endsection