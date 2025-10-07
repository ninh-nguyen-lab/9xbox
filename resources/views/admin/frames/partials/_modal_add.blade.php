<div class="modal fade" id="addRowModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="addFrameForm" action="{{ route('frames.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title">Thêm khung hình mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="add-errors" class="alert alert-danger d-none"></div>
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên khung hình <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $frame->name ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="frame_type">Loại khung <span class="text-danger">*</span></label>
                            <select name="frame_type" id="frame_type" class="form-control">
                                <option value="">-- Chọn loại khung --</option>
                                @foreach($frameTypes as $type)
                                <option value="{{ $type->id }}" {{ old('frame_type', $frame->frame_type ?? '') ==
                                    $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="text" name="price" id="price" class="form-control"
                                value="{{ old('price', isset($frame) ? number_format($frame->price, 0, ',', '.') : '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sale_price" class="form-label">Giá khuyến mãi</label>
                            <input type="text" name="sale_price" id="sale_price" class="form-control"
                                value="{{ old('sale_price', isset($frame) ? number_format($frame->sale_price, 0, ',', '.') : '') }}">
                        </div>

                        {{-- Avatar --}}
                        <div class="col-md-6 mb-3">
                            <label for="avatar">Ảnh đại diện <span class="text-danger">*</span></label>
                            <input type="file" accept="image/*" class="form-control" name="avatar" id="avatar">
                            <img id="preview_avatar"
                                src="{{ isset($frame->avatar) ? asset('storage/'.$frame->avatar) : '' }}" alt="Avatar"
                                height="120"
                                style="display: {{ isset($frame->avatar) ? 'block' : 'none' }}; margin-top:10px;">
                        </div>

                        {{-- Album --}}
                        <div class="col-md-6 mb-3">
                            <label for="album" class="form-label">Album ảnh</label>
                            <input type="file" class="form-control" id="album" name="album[]" multiple>
                            <div id="preview_album" style="margin-top:10px;">
                                @if(!empty($frame->album))
                                @php
                                $albumImages = is_array($frame->album) ? $frame->album : json_decode($frame->album,
                                true);
                                @endphp
                                @foreach($albumImages as $img)
                                <img src="{{ asset('storage/'.$img) }}" height="100"
                                    style="margin-right:10px; margin-top:5px;">
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Mô tả <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="4" name="description"
                                id="description">{{ old('description', $frame->description ?? '') }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="content">Nội dung</label>
                            <textarea class="form-control" rows="10" name="content"
                                id="content">{{ old('content', $frame->content ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" name="tags" id="tags"
                                value="{{ old('tags', $frame->tags ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords"
                                value="{{ old('keywords', $frame->keywords ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="is_hot" class="form-label">Khung nổi bật</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_hot" id="is_hot_1" value="1"
                                        {{ old('is_hot', $frame->is_hot ?? 0) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_hot_1">Có</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_hot" id="is_hot_0" value="0"
                                        {{ old('is_hot', $frame->is_hot ?? 0) == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_hot_0">Không</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Hiển thị</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $frame->status ?? 1) == 1 ? 'selected' : '' }}>Hiển
                                    thị</option>
                                <option value="0" {{ old('status', $frame->status ?? 1) == 0 ? 'selected' : '' }}>Ẩn
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm khung hình</button>
                </div>
            </form>
        </div>
    </div>
</div>