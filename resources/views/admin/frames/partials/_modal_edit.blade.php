<div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Sửa khung hình</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editFrameForm" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- KHÔNG cần @method('PUT') vì mình sẽ override trong AJAX --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_name" class="form-label">Tên khung hình <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_name" name="name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_frame_type">Loại khung</label>
                            <select name="frame_type" id="edit_frame_type" class="form-control">
                                <option value="">-- Chọn loại khung --</option>
                                @foreach($frameTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_price" class="form-label">Giá</label>
                            <input type="text" name="price" id="edit_price" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_sale_price" class="form-label">Giá khuyến mãi</label>
                            <input type="text" name="sale_price" id="edit_sale_price" class="form-control">
                        </div>

                        {{-- Avatar --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_avatar">Ảnh đại diện <span class="text-danger">*</span></label>
                            <input type="file" accept="image/*" class="form-control" name="avatar" id="edit_avatar">
                            <img id="edit_preview_avatar" src="" alt="Avatar" height="120"
                                style="display:none; margin-top:10px;">
                        </div>

                        {{-- Album --}}
                        <div class="col-md-6 mb-3">
                            <label for="edit_album" class="form-label">Album ảnh</label>
                            <input type="file" class="form-control" id="edit_album" name="album[]" multiple>
                            <div id="edit_preview_album" style="margin-top:10px;"></div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="edit_description">Mô tả <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="4" name="description" id="edit_description"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="edit_content">Nội dung</label>
                            <textarea class="form-control" rows="10" name="content" id="edit_content"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_tags">Tags</label>
                            <input type="text" class="form-control" name="tags" id="edit_tags">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_keywords">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="edit_keywords">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_is_hot" class="form-label">Khung nổi bật</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_hot" id="edit_is_hot_1"
                                        value="1">
                                    <label class="form-check-label" for="edit_is_hot_1">Có</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_hot" id="edit_is_hot_0"
                                        value="0" checked>
                                    <label class="form-check-label" for="edit_is_hot_0">Không</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Hiển thị</label>
                            <select name="status" id="edit_status" class="form-control">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-info">Cập nhật khung hình</button>
                </div>
            </form>
        </div>
    </div>
</div>