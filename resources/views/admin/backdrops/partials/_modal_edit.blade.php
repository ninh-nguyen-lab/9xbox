<!-- Modal Edit Backdrop -->
<div class="modal fade" id="editRowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Sửa phông nền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editBackdropForm" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') sẽ override trong AJAX --}}
                <div class="modal-body">
                    <div class="row">
                        {{-- Name --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_name" class="form-label">Tên phông nền <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_name" name="name">
                        </div>

                        {{-- Price --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_price" class="form-label">Giá gốc</label>
                            <input type="text" class="form-control format-number" id="edit_price" name="price">
                        </div>

                        {{-- Avatar --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_avatar" class="form-label">Ảnh đại diện <span class="text-danger">*</span></label>
                            <input type="file" accept="image/*" class="form-control" id="edit_avatar" name="avatar">
                            <img id="edit_preview_avatar" src="" alt="Avatar" height="120"
                                 style="display:none; margin-top:10px;">
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 mb-3">
                            <label for="edit_description" class="form-label">Mô tả</label>
                            <textarea class="form-control" rows="4" name="description" id="edit_description"></textarea>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label">Trạng thái</label>
                            <select class="form-control" id="edit_status" name="status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-info">Cập nhật phông nền</button>
                </div>
            </form>
        </div>
    </div>
</div>