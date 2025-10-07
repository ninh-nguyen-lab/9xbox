<div class="modal fade" id="addBlogModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="addBlogForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title">Thêm tin tức mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="add-blog-errors" class="alert alert-danger d-none"></div>

                    <div class="row">
                        {{-- Tiêu đề --}}
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                        </div>

                        {{-- Avatar --}}
                        <div class="col-md-6 mb-3">
                            <label for="avatar" class="form-label">Ảnh đại diện <span
                                    class="text-danger">*</span></label>
                            <input type="file" accept="image/*" class="form-control" name="avatar" id="avatar">
                            <img id="preview_avatar" src="{{ old('avatar') ? asset('storage/'.old('avatar')) : '' }}"
                                alt="Avatar" height="120" style="display: none; margin-top:10px;">
                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" rows="4" name="description"
                                id="description">{{ old('description') }}</textarea>
                        </div>

                        {{-- Content --}}
                        <div class="col-md-12 mb-3">
                            <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="10" name="content"
                                id="content">{{ old('content') }}</textarea>
                        </div>

                        {{-- Tags --}}
                        <div class="col-md-6 mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" class="form-control" name="tags" id="tags" value="{{ old('tags') }}">
                        </div>

                        {{-- Keywords --}}
                        <div class="col-md-6 mb-3">
                            <label for="keywords" class="form-label">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords"
                                value="{{ old('keywords') }}">
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Hiển thị</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', 1)==1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', 1)==0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
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