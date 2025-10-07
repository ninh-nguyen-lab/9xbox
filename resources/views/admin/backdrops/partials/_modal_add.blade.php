<div class="modal fade" id="addBackdropModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addBackdropForm" action="{{ route('backdrops.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title">Thêm phông nền mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="add-backdrop-errors" class="alert alert-danger d-none"></div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên phông nền <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="text" name="price" id="price" class="form-control"
                                   value="{{ old('price', isset($backdrop) ? number_format($backdrop->price, 0, ',', '.') : '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="avatar" class="form-label">Ảnh đại diện <span class="text-danger">*</span></label>
                            <input type="file" accept="image/*" class="form-control" name="avatar" id="avatar">
                            <img id="preview_avatar"
                                 src="{{ isset($backdrop->avatar) ? asset('storage/'.$backdrop->avatar) : '' }}"
                                 alt="Avatar"
                                 height="120"
                                 style="display: {{ isset($backdrop->avatar) ? 'block' : 'none' }}; margin-top:10px;">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" rows="4" name="description"
                                      id="description">{{ old('description') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Hiển thị</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm phông nền</button>
                </div>
            </form>
        </div>
    </div>
</div>
