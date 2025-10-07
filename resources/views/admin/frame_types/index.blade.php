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
                <li class="nav-item"><a href="#">Loại khung hình</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Danh sách</a></li>
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
                        <h4 class="card-title">Danh sách loại khung hình</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#addFrameTypeModal">
                            <i class="fa fa-plus"></i> Thêm mới
                        </button>
                    </div>
                    <div class="card-body">
                        {{-- Modal add --}}
                        @include('admin.frame_types.partials._modal_add')
                        {{-- Modal edit --}}
                        @include('admin.frame_types.partials._modal_edit')

                        <div class="table-responsive">
                            <table id="frame-types-table" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Trạng thái</th>
                                        <th style="width:10%">Hành động</th>
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
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        // DataTable
        let table = $('#frame-types-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("frame-types.data") }}',
            columns: [
                { data: 'id' },
                { data: 'name' },
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

        // Submit add
        $('#addFrameTypeForm').on('submit', function(e){
            e.preventDefault();
            let form = $(this);
            let formData = new FormData(this);

            $.ajax({
                url: '{{ route("frame-types.store") }}',
                type: 'POST',
                data: formData,
                processData:false,
                contentType:false,
                success: function(res){
                    if(res.success){
                        $('#addFrameTypeModal').modal('hide');
                        table.ajax.reload();
                        form[0].reset();
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

            $.get(`/frame-types/${id}/json`, function(data){
                modal.find('#editFrameTypeForm').attr('action', `/frame-types/${id}`);
                modal.find('#edit_name').val(data.name);
                modal.find('#edit_status').val(data.status);
            });
        });

        // Submit edit
        $('#editFrameTypeForm').on('submit', function(e){
            e.preventDefault();
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
</script>
@endsection
