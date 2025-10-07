<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="addProductForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title">Thêm sản phẩm mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="add-product-errors" class="alert alert-danger d-none"></div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ old('name', $product->name ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Giá <span class="text-danger">*</span></label>
                            <input type="text" name="price" id="price" class="form-control"
                                   value="{{ old('price', isset($product) ? number_format($product->price, 0, ',', '.') : '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sale_price" class="form-label">Giá khuyến mãi</label>
                            <input type="text" name="sale_price" id="sale_price" class="form-control"
                                   value="{{ old('sale_price', isset($product) ? number_format($product->sale_price, 0, ',', '.') : '') }}">
                        </div>

                        {{-- Avatar --}}
                        <div class="col-md-6 mb-3">
                            <label for="avatar">Ảnh đại diện <span class="text-danger">*</span></label>
                            <input type="file" accept="image/*" class="form-control" name="avatar" id="avatar">
                            <img id="preview_avatar"
                                 src="{{ isset($product->avatar) ? asset('storage/'.$product->avatar) : '' }}"
                                 alt="Avatar"
                                 height="120"
                                 style="display: {{ isset($product->avatar) ? 'block' : 'none' }}; margin-top:10px;">
                        </div>

                        {{-- Album --}}
                        <div class="col-md-12 mb-3">
                            <label for="album" class="form-label">Album ảnh</label>
                            <input type="file" class="form-control" id="album" name="album[]" multiple>
                            <div id="preview_album" style="margin-top:10px;">
                                @if(!empty($product->album))
                                    @php
                                        $albumImages = is_array($product->album) ? $product->album : json_decode($product->album,true);
                                    @endphp
                                    @foreach($albumImages as $img)
                                        <img src="{{ asset('storage/'.$img) }}" height="100" style="margin-right:10px; margin-top:5px;">
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Mô tả <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="4" name="description"
                                      id="description">{{ old('description', $product->description ?? '') }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="content">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="10" name="content"
                                      id="content">{{ old('content', $product->content ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" name="tags" id="tags"
                                   value="{{ old('tags', $product->tags ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords"
                                   value="{{ old('keywords', $product->keywords ?? '') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Hiển thị</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $product->status ?? 1) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $product->status ?? 1) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>
