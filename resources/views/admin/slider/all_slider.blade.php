@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a class="btn btn-primary" href="{{URL::to('/add-slider')}}">Thêm mới</a>
            Danh sách slider
        </div>
        <?php
            $message = Session::get('message');
            if($message) {
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message', null);
            }
            ?>
        <div class="table-slider">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                            <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Hình ảnh</th>
                        <th>Link</th>
                        <th>Hiển thị</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_slider as $key => $value_slider)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $value_slider->slider_title }}</td>
                        <td>{{ $value_slider->slider_description }}</td>
                        <td><img src="{{ $value_slider->slider_image }}" alt="" height="100"></td>
                        <td>{{ $value_slider->slider_href }}</td>
                        <td>
                            <span class="text-ellipsis">
                            @if ($value_slider->slider_status == 0)
                            <a href="{{URL::to('/active-slider/'.$value_slider->slider_id )}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                            @else
                            <a href="{{URL::to('/unactive-slider/'.$value_slider->slider_id )}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                            @endif
                            </span>
                        </td>
                        <td>
                            <a href="{{URL::to('/edit-slider/'.$value_slider->slider_id)}}" class="active styling-fa" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa dòng này không?')"
                                href="{{URL::to('/delete-slider/'.$value_slider->slider_id)}}" class="active styling-fa" ui-toggle-class="">
                            <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-12 text-right text-center-xs">                
                    {{ $all_slider->links() }}
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection