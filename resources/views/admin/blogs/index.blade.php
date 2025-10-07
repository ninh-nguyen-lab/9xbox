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
                <li class="nav-item"><a href="#">Tin tức</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Danh sách tin tức</a></li>
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
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title">Danh sách tin tức</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#addBlogModal">
                            <i class="fa fa-plus"></i> Thêm mới
                        </button>
                    </div>
                    <div class="card-body">
                        {{-- Modal add --}}
                        @include('admin.blogs.partials._modal_add')
                        {{-- Modal edit --}}
                        @include('admin.blogs.partials._modal_edit')

                        <div class="table-responsive">
                            <table id="blogs-table" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th style="width:10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- DataTables fill --}}
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
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    // DataTable
    let table = $('#blogs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("blogs.data") }}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'title' },
            { data: 'avatar', render: data => data ? `<img src="${data}" width="80">` : '—' },
            { data: 'description' },
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

    // Preview avatar add
    $('#avatar').on('change', function(e){
        const file = e.target.files[0];
        const preview = $('#preview_avatar');
        if(file){
            const reader = new FileReader();
            reader.onload = ev => preview.attr('src', ev.target.result).show();
            reader.readAsDataURL(file);
        } else {
            preview.attr('src','').hide();
        }
    });

    // Submit add
    $('#addBlogForm').on('submit', function(e){
        e.preventDefault();
        for (instance in CKEDITOR.instances) CKEDITOR.instances[instance].updateElement();

        let form = $(this);
        let formData = new FormData(this);
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        $.ajax({
            url: '{{ route("blogs.store") }}',
            type: 'POST',
            data: formData,
            processData:false,
            contentType:false,
            success: function(res){
                if(res.success){
                    $('#addBlogModal').modal('hide');
                    table.ajax.reload();
                    form[0].reset();
                    $('#preview_avatar').attr('src', '').hide();
                    CKEDITOR.instances['content'].setData('');
                    $('#alert-message').removeClass('d-none alert-danger').addClass('alert-success').text(res.message).fadeIn();
                    setTimeout(() => $('#alert-message').fadeOut(), 3000);
                }
            },
            error: function(xhr){
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages) {
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

    // Load edit
    $('#editRowModal').on('show.bs.modal', function(event){
        const button = $(event.relatedTarget);
        const id = button.data('id');
        const modal = $(this);

        $.get(`blogs/${id}/json`, function(data){
            modal.find('#editBlogForm').attr('action', `blogs/${id}`);
            modal.find('#edit_title').val(data.title);
            modal.find('#edit_tags').val(data.tags);
            modal.find('#edit_keywords').val(data.keywords);
            modal.find('#edit_description').val(data.description);
            modal.find('#edit_status').val(data.status);
            CKEDITOR.instances['edit_content'].setData(data.content || '');

            if(data.avatar_url){
                $('#edit_preview_avatar').attr('src', data.avatar_url).show();
            }else{
                $('#edit_preview_avatar').hide();
            }
        });
    });

    // Preview avatar edit
    $('#edit_avatar').on('change', function(e){
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

    // Submit edit
    $('#editBlogForm').on('submit', function(e){
        e.preventDefault();
        for (instance in CKEDITOR.instances) CKEDITOR.instances[instance].updateElement();

        let form = $(this);
        let formData = new FormData(this);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData:false,
            contentType:false,
            headers: {'X-HTTP-Method-Override':'PUT'},
            success: function(res){
                if(res.success){
                    $('#editRowModal').modal('hide');
                    table.ajax.reload();
                    form[0].reset();
                    CKEDITOR.instances['edit_content'].setData('');
                    $('#alert-message').removeClass('d-none alert-danger').addClass('alert-success').text(res.message).fadeIn();
                    setTimeout(() => $('#alert-message').fadeOut(), 3000);
                }
            },
            error: function(xhr){
                if(xhr.status === 422){
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages){
                        let input = form.find('[name="'+field+'"]');
                        if(input.length){
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback">'+messages[0]+'</div>');
                        }
                    });
                }
            }
        });
    });
});
CKEDITOR.on('dialogDefinition', function (event) {
    var dialogName = event.data.name;
    var dialogDefinition = event.data.definition;

    if (dialogName === 'image') {
        var infoTab = dialogDefinition.getContents('info');

        // Cho phép chỉnh Chiều rộng và Chiều cao
        var widthField = infoTab.get('txtWidth');
        var heightField = infoTab.get('txtHeight');
        var lockField = infoTab.get('ratioLock');

        if (widthField) widthField.disabled = false;
        if (heightField) heightField.disabled = false;
        if (lockField) lockField.disabled = false;

        // Khi mở hộp thoại, tự bật nhập liệu nếu CKFinder vừa set sẵn width/height
        dialogDefinition.onShow = function () {
            var dialog = CKEDITOR.dialog.getCurrent();
            var widthInput = dialog.getContentElement('info', 'txtWidth');
            var heightInput = dialog.getContentElement('info', 'txtHeight');
            if (widthInput) widthInput.enable();
            if (heightInput) heightInput.enable();
        };
    }
});

</script>
@endsection