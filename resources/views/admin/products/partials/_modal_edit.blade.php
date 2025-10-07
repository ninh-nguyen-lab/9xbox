<!-- Modal Edit Product -->
<div class="modal fade" id="editRowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Sửa sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') sẽ override trong AJAX --}}
                <div class="modal-body">
                    <div class="row">
                        {{-- Name --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_name" name="name">
                        </div>

                        {{-- Price --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_price" class="form-label">Giá gốc <span class="text-danger">*</span></label>
                            <input type="text" class="form-control format-number" id="edit_price" name="price">
                        </div>

                        {{-- Sale Price --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_sale_price" class="form-label">Giá khuyến mãi</label>
                            <input type="text" class="form-control format-number" id="edit_sale_price" name="sale_price">
                        </div>

                        {{-- Avatar --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_avatar" class="form-label">Ảnh đại diện <span class="text-danger">*</span></label>
                            <input type="file" accept="image/*" class="form-control" id="edit_avatar" name="avatar">
                            <img id="edit_preview_avatar" src="" alt="Avatar" height="120"
                                 style="display:none; margin-top:10px;">
                        </div>

                        {{-- Album --}}
                        <div class="col-md-12 mb-3">
                            <label for="edit_album" class="form-label">Album ảnh</label>
                            <input type="file" accept="image/*" class="form-control" id="edit_album" name="album[]" multiple>
                            <div id="edit_preview_album" style="margin-top:10px; display:flex; flex-wrap:wrap; gap:10px;"></div>
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 mb-3">
                            <label for="edit_description" class="form-label">Mô tả <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="4" name="description" id="edit_description"></textarea>
                        </div>

                        {{-- Content --}}
                        <div class="col-md-12 mb-3">
                            <label for="edit_content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="10" name="content" id="edit_content"></textarea>
                        </div>

                        {{-- Tags --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_tags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="edit_tags" name="tags">
                        </div>

                        {{-- Keywords --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_keywords" class="form-label">Keywords</label>
                            <input type="text" class="form-control" id="edit_keywords" name="keywords">
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
                    <button type="submit" class="btn btn-info">Cập nhật sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>
