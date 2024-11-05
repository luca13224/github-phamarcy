@extends('layouts.app')
@section('title', 'Thêm thuốc')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold" style="color: #363636;"><strong>Thêm thuốc mới</strong></h3>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('thuoc.store') }}" method="POST">
                @csrf
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="ma_thuoc">Mã Thuốc</label>
                    <input type="number" name="ma_thuoc" class="form-control" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="ten_thuoc">Tên thuốc</label>
                    <input type="text" name="ten_thuoc" class="form-control" id="ten_thuoc" required>
                    <ul id="ten_thuoc_suggestions" class="list-group"></ul>
                </div>
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="thuong_hieu">Thương hiệu</label>
                    <input type="text" name="thuong_hieu" class="form-control" id="thuong_hieu" required>
                    <ul id="thuong_hieu_suggestions" class="list-group"></ul>
                </div>
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="lieu_luong">Liều lượng</label>
                    <input type="text" name="lieu_luong" class="form-control" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="so_luong_ton">Số lượng tồn</label>
                    <input type="number" name="so_luong_ton" class="form-control" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="gia_nhap">Giá nhập</label>
                    <input type="text" name="gia_nhap" class="form-control" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="gia_ban">Giá bán</label>
                    <input type="text" name="gia_ban" class="form-control" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="HSD">HSD</label>
                    <input type="date" name="HSD" class="form-control" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <a href="{{ route('thuoc.index') }}" class="btn btn-secondary ms-2">Trở lại</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function fetchSuggestions(input, listElementId, routeName) {
        input.addEventListener('input', function () {
            const query = this.value;
            if (query.length > 2) {
                fetch(`/${routeName}?term=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        const suggestionsList = document.getElementById(listElementId);
                        suggestionsList.innerHTML = '';
                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item';
                            li.textContent = item.value;
                            suggestionsList.appendChild(li);
                            li.addEventListener('click', function () {
                                input.value = item.value;
                                suggestionsList.innerHTML = '';
                            });
                        });
                    });
            } else {
                document.getElementById(listElementId).innerHTML = '';
            }
        });
    }

    const tenThuocInput = document.getElementById('ten_thuoc');
    fetchSuggestions(tenThuocInput, 'ten_thuoc_suggestions', 'thuoc/autocomplete-ten-thuoc');

    const thuongHieuInput = document.getElementById('thuong_hieu');
    fetchSuggestions(thuongHieuInput, 'thuong_hieu_suggestions', 'thuoc/autocomplete-thuong-hieu');
});
</script>
@endsection
