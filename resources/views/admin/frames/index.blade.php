@extends('admin.layouts.main')
@section('admin_content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Khung hình</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Danh sách khung hình</a></li>
            </ul>
        </div>

        {{-- Flash message --}}
        @if(Session::has('message'))
        <div id="alert-message" class="alert alert-success">{{ Session::get('message') }}</div>
        @else
        <div id="alert-message" class="alert d-none"></div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Danh sách loại khung</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Thêm mới
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Filter loại khung --}}
                        <div class="mb-3">
                            <label for="filterFrameType" class="form-label">Lọc theo loại khung:</label>
                            <select id="filterFrameType" class="form-select" style="width:200px; display:inline-block;">
                                <option value="">-- Tất cả --</option>
                                @foreach($frameTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Modal -->
                        @include('admin.frames.partials._modal_add')
                        @include('admin.frames.partials._modal_edit')

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Loại khung</th>
                                        <th>Hot</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-scripts')
<script>
    $(document).ready(function () {
        CKEDITOR.replace('content', {
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}"
        });
        CKEDITOR.replace('edit_content', {
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}"
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Add Row
        let table = $('#add-row').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("frames.data") }}',
                data: function (d) {
                    d.frame_type_id = $('#filterFrameType').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'avatar', render: data => data ? `<img src="${data}" width="60">` : '—' },
                { data: 'name' },
                { data: 'price' },
                { data: 'frame_type' },
                { data: 'is_hot', 
                    render: function(data){
                        return data == 1 
                            ? '<span class="badge bg-warning text-dark">Hot</span>' 
                            : '';
                    } 
                },
                { data: 'status', 
                    render: function(data){
                        return data == 1 
                            ? '<span class="badge bg-success">Hiện</span>' 
                            : '<span class="badge bg-secondary">Ẩn</span>';
                    } 
                },
                { data: 'action', orderable: false, searchable: false }
            ]
        });

        // Avatar
        $('#avatar').on('change', function(e){
            const preview = $('#preview_avatar');
            const file = e.target.files[0];

            if(file){
                const reader = new FileReader();
                reader.onload = function(ev){
                    preview.attr('src', ev.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                preview.attr('src', '').hide();
            }
        });

        $('#album').on('change', function(e){
            const previewDiv = $('#preview_album');
            previewDiv.html('');
            const files = e.target.files;

            if(files.length){
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(ev){
                        const img = $('<img>').attr('src', ev.target.result)
                                            .css({height:'100px', marginRight:'10px', marginTop:'5px'});
                        previewDiv.append(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });
    
        // reload khi chọn filter
        $('#filterFrameType').on('change', function () {
            table.ajax.reload();
        });

        // Xử lý thêm khung hình
        $('#addFrameForm').on('submit', function (e) {
            e.preventDefault();
            for (instance in CKEDITOR.instances) CKEDITOR.instances[instance].updateElement();
            let form = $(this);
            let formData = new FormData(this);

            // clear lỗi cũ
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.invalid-feedback').remove();

            $.ajax({
                url: '{{ route("frames.store") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.success) {
                        $('#addRowModal').modal('hide');
                        table.ajax.reload();
                        form[0].reset();
                        $('#preview_avatar').attr('src', '').hide();
                        $('#preview_album').html('');
                        CKEDITOR.instances['content'].setData('');

                        $('#alert-message').removeClass('d-none alert-danger').addClass('alert-success').text(res.message).fadeIn();

                        setTimeout(() => $('#alert-message').fadeOut(), 3000);
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function (field, messages) {
                            let input = form.find('[name="' + field + '"]');

                            if (input.length) {
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                            }
                        });
                    }
                }
            });
        });

        // Load dữ liệu khi mở modal edit
        $('#editRowModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const frameId = button.data('id');
            const modal = $(this);

            $.get(`frames/${frameId}/json`, function (data) {
                modal.find('#editFrameForm').attr('action', `frames/${frameId}`);
                modal.find('#edit_name').val(data.name);
                modal.find('#edit_frame_type').val(data.frame_type_id).trigger('change');
                modal.find('#edit_price').val(data.price);
                modal.find('#edit_sale_price').val(data.sale_price);
                modal.find('#edit_description').val(data.description);
                modal.find('#edit_content').val(data.content);
                modal.find('#edit_tags').val(data.tags);
                modal.find('#edit_keywords').val(data.keywords);
                modal.find('#edit_status').val(data.status);
                if (data.is_hot == 1) {
                    modal.find('#edit_is_hot_1').prop('checked', true);
                } else {
                    modal.find('#edit_is_hot_0').prop('checked', true);
                }
                CKEDITOR.instances['edit_content'].setData(data.content || '');

                // Avatar
                if (data.avatar_url) {
                    $('#edit_preview_avatar').attr('src', data.avatar_url).show();
                } else {
                    $('#edit_preview_avatar').hide();
                }

                // Album
                const previewDiv = $('#edit_preview_album').html('');
                if (data.album_urls && data.album_urls.length) {
                    data.album_urls.forEach(url => {
                        $('<img>').attr('src', url)
                            .css({ height: '100px', marginRight: '10px', marginTop: '5px' })
                            .appendTo(previewDiv);
                    });
                }
            });
        });

        // Preview avatar edit
        $('#edit_avatar').on('change', function (e) {
            const file = e.target.files[0];
            const preview = $('#edit_preview_avatar');
            if (file) {
                const reader = new FileReader();
                reader.onload = ev => preview.attr('src', ev.target.result).show();
                reader.readAsDataURL(file);
            } else {
                preview.attr('src', '').hide();
            }
        });

        // Preview album edit
        $('#edit_album').on('change', function (e) {
            const previewDiv = $('#edit_preview_album').html('');
            const files = e.target.files;
            if (files.length) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = ev => {
                        $('<img>').attr('src', ev.target.result)
                            .css({ height: '100px', marginRight: '10px', marginTop: '5px' })
                            .appendTo(previewDiv);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });

        // Submit form edit
        $('#editFrameForm').on('submit', function (e) {
            e.preventDefault();
            for (instance in CKEDITOR.instances) CKEDITOR.instances[instance].updateElement();
            let form = $(this);
            let formData = new FormData(this);

            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.invalid-feedback').remove();

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-HTTP-Method-Override': 'PUT' },
                success: function (res) {
                    if (res.success) {
                        $('#editRowModal').modal('hide');
                        table.ajax.reload();
                        form[0].reset();
                        CKEDITOR.instances['edit_content'].setData('');
                        $('#alert-message').removeClass('d-none alert-danger').addClass('alert-success').text(res.message).fadeIn();
                        setTimeout(() => $('#alert-message').fadeOut(), 3000);
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (field, messages) {
                            let input = form.find('[name="' + field + '"]');
                            if (input.length) {
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' + messages[0] + '</div>');
                            }
                        });
                    }
                }
            });
        });

        function formatVND(input) {
            let value = input.value.replace(/\D/g, ''); // bỏ ký tự không phải số
            if (!value) {
                input.value = '';
                return;
            }
            input.value = new Intl.NumberFormat('vi-VN').format(value);
        }

        // Gắn sự kiện
        $('#edit_price, #edit_sale_price, #price, #sale_price').on('input', function () {
            formatVND(this);
        });
    });
</script>
@endsection