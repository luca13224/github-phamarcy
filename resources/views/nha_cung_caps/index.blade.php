@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Nhà Cung Cấp <i class="fas fa-truck-moving"></i></h1>
        <a href="{{ route('nha-cung-caps.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Thêm Nhà Cung Cấp
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Mã NCC <i class="fas fa-id-card"></i></th>
                    <th>Tên <i class="fas fa-user"></i></th>
                    <th>SĐT <i class="fas fa-phone"></i></th>
                    <th>Địa Chỉ <i class="fas fa-map-marker-alt"></i></th>
                    <th>Hành động <i class="fas fa-cogs"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($nhaCungCaps as $ncc)
                <tr>
                    <td>{{ $ncc->ma_NCC }}</td>
                    <td>{{ $ncc->ten_NCC }}</td>
                    <td>{{ $ncc->SDT }}</td>
                    <td>{{ $ncc->dia_chi }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('nha-cung-caps.edit', $ncc->ma_NCC) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $ncc->ma_NCC }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>

                        <!-- Modal xác nhận xóa -->
                        <div class="modal fade" id="deleteModal{{ $ncc->ma_NCC }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $ncc->ma_NCC }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $ncc->ma_NCC }}">Xác nhận xóa <i class="fas fa-exclamation-triangle"></i></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc chắn muốn xóa nhà cung cấp này không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <form action="{{ route('nha-cung-caps.destroy', $ncc->ma_NCC) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div class="d-flex justify-content-center">
    {{ $nhaCungCaps->links() }} <!-- Phân trang -->
</div>
@endsection
<style>
    .btn-custom-size {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }

    .pencil-icon, .trash-icon {
        transition: transform 0.2s;
    }

    .pencil-icon:hover, .trash-icon:hover {
        transform: scale(1.2);
    }

    .table-hover tbody tr:hover {
        background-color: #f2f2f2;
    }

    .btn-primary {
        background: linear-gradient(45deg, #007bff, #00d4ff);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table th, .table td {
        white-space: nowrap;
    }

    .btn-group {
        display: flex;
        justify-content: center;
    }

    .modal-content {
        border-radius: 10px;
    }

    .modal-header, .modal-footer {
        border: none;
    }

    .btn-close {
        background-color: #f2f2f2;
        border: none;
    }

    .btn-close:hover {
        background-color: #e6e6e6;
    }

    .btn-close:focus {
        box-shadow: none;
    }
</style>
