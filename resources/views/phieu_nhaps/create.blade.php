@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tạo Phiếu Nhập Mới</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('phieu-nhaps.store') }}" method="POST">
        @csrf
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="ngay_dat">Ngày Đặt</label>
            <input type="date" name="ngay_dat" class="form-control" required>
        </div>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="ngay_nhan">Ngày Nhận</label>
            <input type="date" name="ngay_nhan" class="form-control" required>
        </div>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="thuoc">Chọn Thuốc</label>
            <div id="thuoc-container">
                <div class="thuoc-item mb-3">
                    <select name="thuoc[0][ma_thuoc]" class="form-control" required>
                        <option value="">Chọn thuốc</option>
                        @foreach ($thuocs as $thuoc)
                            <option value="{{ $thuoc->ma_thuoc }}">{{ $thuoc->ten_thuoc }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="thuoc[0][so_luong]" class="form-control mt-2" placeholder="Số lượng" required min="1">
                </div>
            </div>
            <div class="input-group mt-3 mb-3">
            <button type="button" class="btn btn-secondary" id="add-thuoc">Thêm thuốc</button>
            </div>
            <div class="input-group mt-3 mb-3">
            <button type="submit" class="btn btn-primary">Lưu Phiếu Nhập</button>
            <a href="{{ route('phieu-nhaps.index') }}" class="btn btn-secondary ms-2">Trở lại</a>
        </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-thuoc').addEventListener('click', function() {
        const container = document.getElementById('thuoc-container');
        const index = container.children.length; // Tìm index mới
        const newItem = document.createElement('div');
        newItem.classList.add('thuoc-item', 'mb-3');
        newItem.innerHTML = `
            <select name="thuoc[${index}][ma_thuoc]" class="form-control" required>
                <option value="">Chọn thuốc</option>
                @foreach ($thuocs as $thuoc)
                    <option value="{{ $thuoc->ma_thuoc }}">{{ $thuoc->ten_thuoc }}</option>
                @endforeach
            </select>
            <input type="number" name="thuoc[${index}][so_luong]" class="form-control mt-2" placeholder="Số lượng" required min="1">
        `;
        container.appendChild(newItem);
    });
</script>
@endsection
