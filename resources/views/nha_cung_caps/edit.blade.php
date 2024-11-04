@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Sửa Nhà Cung Cấp</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('nha-cung-cap.update', $nhacungcap->ma_NCC) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ten_NCC">Tên Nhà Cung Cấp</label>
            <input type="text" class="form-control" id="ten_NCC" name="ten_NCC" value="{{ old('ten_NCC', $nhacungcap->ten_NCC) }}" required>
        </div>
        <div class="form-group">
            <label for="SDT">Số Điện Thoại</label>
            <input type="text" class="form-control" id="SDT" name="SDT" value="{{ old('SDT', $nhacungcap->SDT) }}" required>
        </div>
        <div class="form-group">
            <label for="dia_chi">Địa Chỉ</label>
            <input type="text" class="form-control" id="dia_chi" name="dia_chi" value="{{ old('dia_chi', $nhacungcap->dia_chi) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Cập Nhật</button>
        <a href="{{ route('nha-cung-cap.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection
