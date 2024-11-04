@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h2><i class="fas fa-users"></i> Quản lý <b>Nhân Viên</b></h2>
                    </div>
                    <div class="col-sm-4 text-right">
                        <a href="{{ route('nhan-viens.create') }}" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i> <span>Thêm Nhân Viên Mới</span>
                        </a>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th><i class="fas fa-id-badge"></i> Mã Nhân Viên</th>
                        <th><i class="fas fa-user"></i> Tên Nhân Viên</th>
                        <th><i class="fas fa-phone"></i> SDT</th>
                        <th><i class="fas fa-map-marker-alt"></i> Địa Chỉ</th>
                        <th><i class="fas fa-birthday-cake"></i> Ngày Sinh</th>
                        <th><i class="fas fa-cogs"></i> Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nhanviens as $nhanvien)
                        <tr>
                            <td>{{ $nhanvien->ma_NV }}</td>
                            <td>{{ $nhanvien->ten_NV }}</td>
                            <td>{{ $nhanvien->SDT }}</td>
                            <td>{{ $nhanvien->dia_chi }}</td>
                            <td>{{ $nhanvien->ngay_sinh }}</td>
                            <td>
                                <a href="{{ route('nhan-viens.edit', $nhanvien->ma_NV) }}" class="edit">
                                    <i class="fas fa-edit" data-toggle="tooltip" title="Sửa" style="color: #007bff;"></i>
                                </a>
                                <form action="{{ route('nhan-viens.destroy', $nhanvien->ma_NV) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete btn btn-custom-size" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" style="background-color: #f8d7da;">
                                        <i class="fas fa-trash" data-toggle="tooltip" title="Xóa" style="color: #dc3545;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $nhanviens->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome and jQuery for icons and effects -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

        // Highlight row on hover
        $('table.table-hover tbody tr').hover(function(){
            $(this).addClass('table-warning');
        }, function(){
            $(this).removeClass('table-warning');
        });

    });
</script>
@endsection
