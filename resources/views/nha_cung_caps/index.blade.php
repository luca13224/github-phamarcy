@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nhà Cung Cấp</h1>
    <a href="{{ route('nha-cung-cap.create') }}" class="btn btn-primary mb-3">Thêm Nhà Cung Cấp</a>
    <table class="table">
        <thead>
            <tr>
                <th>Mã NCC</th>
                <th>Tên</th>
                <th>SĐT</th>
                <th>Địa Chỉ</th>
                <th>Hành động</th>
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
                    <a href="{{ route('nha-cung-cap.edit', $ncc->ma_NCC) }}" class="btn btn-outline-warning btn-custom-size"><i class="bi bi-pencil pencil-icon"></i></a>
                    <button type="button" class="btn btn-outline-danger btn-custom-size" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $ncc->id }}"><i class="bi bi-trash trash-icon"></i></button>
        
                                <!-- Modal xác nhận xóa -->
                                <div class="modal fade" id="deleteModal{{ $ncc->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $ncc->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $ncc->id }}">Xác nhận xóa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa nhà cung cấp này không?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <form action="{{ route('nha-cung-cap.destroy', $ncc->id) }}" method="POST" style="display:inline;">
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
</div>
@endsection
