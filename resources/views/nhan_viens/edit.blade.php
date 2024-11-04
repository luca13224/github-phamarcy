@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Sửa <b>Nhân Viên</b></h2></div>
            </div>
        </div>
        <form action="{{ route('nhan-viens.update', $nhanvien->ma_NV) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ma_NV">Mã Nhân Viên</label>
                <input type="number" class="form-control" id="ma_NV" name="ma_NV" value="{{ $nhanvien->ma_NV }}" readonly>
            </div>
            <div class="form-group">
                <label for="ten_NV">Tên Nhân Viên</label>
                <input type="text" class="form-control" id="ten_NV" name="ten_NV" value="{{ $nhanvien->ten_NV }}" required>
            </div>
            <div class="form-group">
                <label for="SDT">Số Điện Thoại</label>
                <input type="text" class="form-control" id="SDT" name="SDT" value="{{ $nhanvien->SDT }}" required>
            </div>
            <div class="form-group">
                <label for="dia_chi">Địa Chỉ</label>
                <input type="text" class="form-control" id="dia_chi" name="dia_chi" value="{{ $nhanvien->dia_chi }}" required>
            </div>
            <div class="form-group">
                <label for="ngay_sinh">Ngày Sinh</label>
                <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" value="{{ $nhanvien->ngay_sinh }}" required>
            </div>
            <button type="submit" class="btn btn-success">Cập Nhật</button>
            <a href="{{ route('nhan-viens.index') }}" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
</div>
@endsection
