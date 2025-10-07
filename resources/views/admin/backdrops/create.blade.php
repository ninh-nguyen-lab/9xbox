@extends('admin.layouts.main')
@section('admin_content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Phông nền</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Thêm phông nền</a></li>
            </ul>
        </div>

        {{-- Hiển thị message session --}}
        @if (Session::has('message'))
            <span class="text-alert">{{ Session::get('message') }}</span>
            @php Session::forget('message'); @endphp
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thêm phông nền</div>
                    </div>
                    <form action="{{ route('backdrops.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">

                                {{-- Tên phông nền --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Tên phông nền <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                            value="{{ old('name') }}">
                                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Giá --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Giá</label>
                                        <input type="text" class="form-control" id="price" name="price" 
                                            value="{{ old('price') }}">
                                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Ảnh đại diện --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="avatar">Ảnh đại diện <span class="text-danger">*</span></label>
                                        <input type="file" accept="image/*" class="form-control" id="avatar" name="avatar">
                                        <div class="mt-2">
                                            <img id="preview_avatar" src="" alt="Preview" class="border rounded"
                                                height="120" style="display:none;">
                                        </div>
                                        @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Mô tả --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea class="form-control" rows="4" id="description" 
                                            name="description">{{ old('description') }}</textarea>
                                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Trạng thái --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hiển thị</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status')=="1" ? 'selected' : '' }}>Hiển thị</option>
                                            <option value="0" {{ old('status')=="0" ? 'selected' : '' }}>Ẩn</option>
                                        </select>
                                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('backdrops.index') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Thêm phông nền</button>
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
    // Format number input
    function formatNumberInput(input) {
        input.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, "");
            e.target.value = value ? new Intl.NumberFormat('vi-VN').format(value) : '';
        });
    }
    formatNumberInput(document.getElementById('price'));

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
</script>
@endsection
