@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm slider
            </header>
            <div class="panel-body">
                <?php
                    $message = Session::get('message');
                    if($message) {
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message', null);
                    }
                    ?>
                <div class="">
                    <form role="form" action="{{URL::to('/save-slider')}}" id="save_slider" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="slider_title">Tiêu đề <span class="required">*</span></label>
                            <input type="text" class="form-control" name="slider_title" id="slider_title" placeholder="Tiêu đề">
                        </div>
                        <div class="form-group">
                            <label for="slider_image">Ảnh Slider <span class="required">*</span></label>
                            <input type="file" accept="image/*" class="form-control" name="slider_image" id="slider_image" placeholder="Ảnh Slider">
                        </div>
                        <div class="form-group">
                            <label for="slider_href">Link <span class="required">*</span></label>
                            <input type="text" class="form-control" name="slider_href" id="slider_href" placeholder="Link">
                        </div>
                        <div class="form-group">
                            <label for="slider_description">Mô tả</label>
                            <textarea style="resize: none" rows="3" class="form-control" name="slider_description" id="slider_description" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Hiển thị</label>
                            <select name="slider_status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <a class="btn btn-danger" href="{{URL::to('/all-slider')}}">Cancel</a>
                        <button type="submit" class="btn btn-info">Thêm Slider</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- ckeditor -->
<script type="text/javascript">
    $("#save_slider").validate({
        ignore: [],
        rules: {
            slider_title: "required",
            slider_href: "required",
            slider_image: {
                required: true,
                extension: "jpg|jpeg|png|ico|bmp"
            }
        },
        messages: {
            slider_title: "Vui lòng nhập tiêu đề",
            slider_href: "Vui lòng nhập link",
            slider_image: {
                required: "Vui lòng chọn ảnh đại diện",
                extension: "Vui lòng chọn file hình ảnh"
            }
        },
    });
    
</script>
<!-- //ckeditor -->
@endsection