@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Thêm Nhà Cung Cấp</h2>
    <form action="{{ route('nha-cung-cap.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ma_NCC">Mã Nhà Cung Cấp</label>
            <input type="text" class="form-control" id="ma_NCC" name="ma_NCC" required>
        </div>
        <div class="form-group">
            <label for="ten_NCC">Tên Nhà Cung Cấp</label>
            <input type="text" class="form-control" id="ten_NCC" name="ten_NCC" required>
        </div>
        <div class="form-group">
            <label for="SDT">Số Điện Thoại</label>
            <input type="text" class="form-control" id="SDT" name="SDT" required>
        </div>
        <div class="form-group">
            <label for="dia_chi">Địa Chỉ</label>
            <input type="text" class="form-control" id="dia_chi" name="dia_chi" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="{{ route('nha-cung-cap.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection
