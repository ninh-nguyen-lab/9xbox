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
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Cài đặt</a></li>
            </ul>
        </div>

        {{-- Hiển thị message session --}}
        @if (Session::has('message'))
            <span class="text-alert">{{ Session::get('message') }}</span>
            @php Session::forget('message'); @endphp
        @endif

        {{-- Hiển thị lỗi chung --}}
        @if($errors->any())
        <div class="alert alert-danger">
            <strong>Có lỗi xảy ra!</strong> Vui lòng kiểm tra lại các tab để sửa lỗi.
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Cài đặt hệ thống</div>
                    </div>
                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            {{-- Tabs --}}
                            <ul class="nav nav-tabs" id="settingTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="company-tab" data-bs-toggle="tab" data-bs-target="#company" type="button" role="tab">Thông tin công ty</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="introduce-tab" data-bs-toggle="tab" data-bs-target="#introduce" type="button" role="tab">Giới thiệu</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="map-tab" data-bs-toggle="tab" data-bs-target="#map" type="button" role="tab">Bản đồ</button>
                                </li>
                            </ul>

                            {{-- Tab content --}}
                            <div class="tab-content mt-3" id="settingTabsContent">
                                {{-- Company --}}
                                <div class="tab-pane fade show active" id="company" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên công ty <span class="text-danger">*</span></label>
                                                <input type="text" name="company_name" class="form-control"
                                                    value="{{ old('company_name', $settings['company_name']) }}">
                                                @error('company_name') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="company_email" class="form-control"
                                                    value="{{ old('company_email', $settings['company_email']) }}">
                                                @error('company_email') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Địa chỉ <span class="text-danger">*</span></label>
                                                <input type="text" name="company_address" class="form-control"
                                                    value="{{ old('company_address', $settings['company_address']) }}">
                                                @error('company_address') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Số điện thoại <span class="text-danger">*</span></label>
                                                <input type="text" name="company_phone" class="form-control"
                                                    value="{{ old('company_phone', $settings['company_phone']) }}">
                                                @error('company_phone') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="company_favicon">Favicon <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" name="company_favicon" id="company_favicon" accept=".ico,image/*">
                                                <div class="mt-2">
                                                    @if (!empty($settings['company_favicon']))
                                                    <img id="preview_favicon" src="{{ asset($settings['company_favicon']) }}" height="32" width="32">
                                                    @else
                                                    <img id="preview_favicon" style="display:none;" height="32" width="32">
                                                    @endif
                                                </div>
                                                @error('company_favicon') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="company_logo">Logo <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" name="company_logo" id="company_logo" accept="image/*">
                                                <div class="mt-2">
                                                    @if (!empty($settings['company_logo']))
                                                    <img id="preview_logo" src="{{ asset($settings['company_logo']) }}" height="60">
                                                    @else
                                                    <img id="preview_logo" style="display:none;" height="60">
                                                    @endif
                                                </div>
                                                @error('company_logo') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title Website <span class="text-danger">*</span></label>
                                                <input type="text" name="company_title" class="form-control"
                                                    value="{{ old('company_title', $settings['company_title']) }}">
                                                @error('company_title') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Keywords Website <span class="text-danger">*</span></label>
                                                <textarea name="company_keywords" class="form-control" rows="2">{{ old('company_keywords', $settings['company_keywords']) }}</textarea>
                                                @error('company_keywords') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description Website <span class="text-danger">*</span></label>
                                                <textarea name="company_description" class="form-control" rows="3">{{ old('company_description', $settings['company_description']) }}</textarea>
                                                @error('company_description') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Introduce --}}
                                <div class="tab-pane fade" id="introduce" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="introduce_image">Ảnh giới thiệu <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" name="introduce_image" id="introduce_image" accept="image/*">
                                                @if($settings['introduce_image'] ?? false)
                                                <div class="mt-2">
                                                    <p>Ảnh hiện tại:</p>
                                                    <img src="{{ asset($settings['introduce_image']) }}" height="120" id="introduce_image_old">
                                                </div>
                                                @endif
                                                <div class="mt-2" id="introduce_image_preview_wrapper" style="display:none;">
                                                    <p>Ảnh mới chọn:</p>
                                                    <img id="introduce_image_preview" height="120">
                                                </div>
                                                @error('introduce_image') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mô tả <span class="text-danger">*</span></label>
                                                <textarea name="introduce_description" class="form-control" rows="3">{{ old('introduce_description', $settings['introduce_description']) }}</textarea>
                                                @error('introduce_description') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Nội dung <span class="text-danger">*</span></label>
                                                <textarea name="introduce_content" class="form-control" rows="6">{{ old('introduce_content', $settings['introduce_content']) }}</textarea>
                                                @error('introduce_content') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Map --}}
                                <div class="tab-pane fade" id="map" role="tabpanel">
                                    <div class="form-group">
                                        <label>Nội dung bản đồ (iframe Google Maps)</label>
                                        <textarea name="map_content" class="form-control" rows="6">{{ old('map_content', $settings['map_content']) }}</textarea>
                                        @error('map_content') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('custom-scripts')
<script>
    CKEDITOR.replace('introduce_content', {
        filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
        filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
        filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}"
    });
    // Preview logo
    document.getElementById('company_logo').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = e => {
            let img = document.getElementById('preview_logo');
            img.src = e.target.result;
            img.style.display = 'block';
        }
        if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
    });

    // Preview favicon
    document.getElementById('company_favicon').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = e => {
            let img = document.getElementById('preview_favicon');
            img.src = e.target.result;
            img.style.display = 'block';
        }
        if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
    });

    // Preview introduce image
    document.getElementById('introduce_image').addEventListener('change', function (e) {
        const [file] = this.files;
        if (file) {
            const wrapper = document.getElementById('introduce_image_preview_wrapper');
            const preview = document.getElementById('introduce_image_preview');
            preview.src = URL.createObjectURL(file);
            wrapper.style.display = 'block';
        }
    });
</script>
@endsection
