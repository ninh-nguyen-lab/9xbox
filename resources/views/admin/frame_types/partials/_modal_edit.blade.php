<div class="modal fade" id="editRowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Cập nhật loại khung hình</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editFrameTypeForm" method="POST">
                @csrf
                {{-- @method('PUT') sẽ override bằng AJAX --}}
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Tên loại khung hình <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="edit_name">
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Trạng thái</label>
                        <select name="status" id="edit_status" class="form-control">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-info">Cập nhật loại khung hình</button>
                </div>
            </form>
        </div>
    </div>
</div>
