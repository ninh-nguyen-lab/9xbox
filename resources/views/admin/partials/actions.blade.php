<div class="d-flex align-items-center gap-1">
    {{-- Nút Active / Unactive nếu model có field status --}}
    @isset($item->status)
    @if ($item->status == 1)
    <form action="{{ route($routeBase . '.unactive', $item) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Đang hiện">
            <i class="fa fa-eye"></i>
        </button>
    </form>
    @else
    <form action="{{ route($routeBase . '.active', $item) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Đang ẩn">
            <i class="fa fa-eye-slash"></i>
        </button>
    </form>
    @endif
    @endisset

    <button type="button" class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#editRowModal"
        data-id="{{ $item->id }}">
        <i class="fa fa-edit"></i>
    </button>

    <form action="{{ route($routeBase . '.destroy', $item) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Xóa"
            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
            <i class="fa fa-times"></i>
        </button>
    </form>
</div>