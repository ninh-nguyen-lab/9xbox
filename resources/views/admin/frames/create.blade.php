@extends('admin.layouts.main')
@section('admin_content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Khung hình</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thêm khung hình</a>
                </li>
            </ul>
        </div>

        <?php
            $message = Session::get('message');
            if($message) {
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message', null);
            }
            ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thêm khung hình</div>
                    </div>
                    <form action="{{ route('frames.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">

                                {{-- Tên khung hình --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Tên khung hình <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name') }}">
                                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Loại khung --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="frame_type">Loại khung <span class="text-danger">*</span></label>
                                        <select name="frame_type" id="frame_type" class="form-control">
                                            <option value="">-- Chọn loại khung --</option>
                                            @foreach($frameTypes as $type)
                                            <option value="{{ $type->id }}" {{ old('frame_type')==$type->id ? 'selected'
                                                : '' }}>
                                                {{ $type->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('frame_type') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Giá --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Giá</label>
                                        <input type="text" name="price" id="price" class="form-control"
                                            value="{{ old('price') }}">
                                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Giá khuyến mãi --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sale_price">Giá khuyến mãi</label>
                                        <input type="text" name="sale_price" id="sale_price" class="form-control"
                                            value="{{ old('sale_price') }}">
                                        @error('sale_price') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Ảnh đại diện --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="avatar">Ảnh đại diện <span class="text-danger">*</span></label>
                                        <input type="file" accept="image/*" class="form-control" name="avatar"
                                            id="avatar">
                                        <div class="mt-2">
                                            <img id="preview_avatar" src="" alt="Preview" class="border rounded"
                                                height="120" style="display:none;">
                                        </div>
                                        @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Album ảnh --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="album">Album ảnh</label>
                                        <input type="file" class="form-control" id="album" name="album[]" multiple>
                                        <div id="preview_album" class="d-flex flex-wrap mt-2"></div>
                                        @error('album') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Mô tả --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Mô tả <span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="description"
                                            id="description">{{ old('description') }}</textarea>
                                        @error('description') <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Nội dung --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">Nội dung</label>
                                        <textarea class="form-control" rows="10" name="content"
                                            id="content">{{ old('content') }}</textarea>
                                        @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Tags --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tags">Tags</label>
                                        <input type="text" class="form-control" name="tags" id="tags"
                                            value="{{ old('tags') }}">
                                        @error('tags') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Keywords --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keywords">Keywords</label>
                                        <input type="text" class="form-control" name="keywords" id="keywords"
                                            value="{{ old('keywords') }}">
                                        @error('keywords') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Nổi bật --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Nổi bật</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="is_hot"
                                                    id="is_hot_yes" value="1" {{ old('is_hot')=="1" ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_hot_yes">Có</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_hot"
                                                    id="is_hot_no" value="0" {{ old('is_hot', '0' )=="0" ? 'checked'
                                                    : '' }}>
                                                <label class="form-check-label" for="is_hot_no">Không</label>
                                            </div>
                                        </div>
                                        @error('is_hot') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Trạng thái --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hiển thị</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status')=="1" ? 'selected' : '' }}>Hiển thị
                                            </option>
                                            <option value="0" {{ old('status')=="0" ? 'selected' : '' }}>Ẩn</option>
                                        </select>
                                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-action">
                            <a class="btn btn-danger" href="{{ route('frames.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-success">Thêm khung hình</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-scripts')
<script type="text/javascript">
    CKEDITOR.replace('content', {
        filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
        filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
        filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}"
    });

    function formatNumberInput(input) {
        input.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, "");
            e.target.value = value ? new Intl.NumberFormat('vi-VN').format(value) : '';
        });
    }
    formatNumberInput(document.getElementById('price'));
    formatNumberInput(document.getElementById('sale_price'));

    // Preview avatar
    document.getElementById("avatar").addEventListener("change", function(event) {
        let file = event.target.files[0];
        if (!file) return;
        let reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById("preview_avatar");
            preview.src = e.target.result;
            preview.style.display = "block";
        }
        reader.readAsDataURL(file);
    });

    // Preview album
    document.getElementById("album").addEventListener("change", function(event) {
        let files = event.target.files;
        let previewContainer = document.getElementById("preview_album");
        previewContainer.innerHTML = "";
        Array.from(files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.createElement("img");
                img.src = e.target.result;
                img.height = 80;
                img.classList.add("me-2", "mb-2", "border", "rounded");
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection