<div class="modal fade" id="editRowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Sửa tin tức</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editBlogForm" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') sẽ override trong AJAX --}}
                <div class="modal-body">
                    <div class="row">
                        {{-- Title --}}
                        <div class="col-md-12 mb-3">
                            <label for="edit_title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_title" name="title">
                        </div>

                        {{-- Avatar --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_avatar" class="form-label">Ảnh đại diện</label>
                            <input type="file" accept="image/*" class="form-control" id="edit_avatar" name="avatar">
                            <img id="edit_preview_avatar" src="" alt="Avatar" height="120"
                                 style="display:none; margin-top:10px;">
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 mb-3">
                            <label for="edit_description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="4" id="edit_description" name="description"></textarea>
                        </div>

                        {{-- Content --}}
                        <div class="col-md-12 mb-3">
                            <label for="edit_content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="10" id="edit_content" name="content"></textarea>
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
                    <button type="submit" class="btn btn-info">Cập nhật tin tức</button>
                </div>
            </form>
        </div>
    </div>
</div>
