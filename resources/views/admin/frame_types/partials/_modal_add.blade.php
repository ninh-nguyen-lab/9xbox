<div class="modal fade" id="addFrameTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addFrameTypeForm" action="{{ route('frame-types.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title">Thêm loại khung hình mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="add-frame-type-errors" class="alert alert-danger d-none"></div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên loại khung hình <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Hiển thị</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status', 1)=="1" ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ old('status')=="0" ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
