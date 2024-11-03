@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <h2><b>Lịch Sử Mua Hàng</b></h2>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('khach-hangs.index') }}" class="btn btn-secondary ms-2"><span>Trở lại</span></a>
                    </div>
                </div>
            </div>
            <form method="GET" action="{{ route('lich-su-mua.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="ten_khach_hang" placeholder="Tìm kiếm tên khách hàng" value="{{ request('ten_khach_hang') }}" class="form-control" required>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Tên KH</th>
                        <th>Số Đơn Hàng</th>
                        <th>Tổng Chi Tiêu</th>
                        <th>Ngày Mua Gần Nhất</th>
                    </tr>
                </thead>
                <tbody>
                    @if($paginator->count() > 0)
                        @foreach($paginator as $item)
                        <tr>
                            <td>{{ $item->ma_KH }}</td>
                            <td>{{ $item->ten_KH }}</td>
                            <td>{{ $item->So_don_hang }}</td>
                            <td>{{ number_format($item->Tong_chi_tieu, 2) }} VNĐ</td>
                            <td>{{ $item->ngay_mua_gan_nhat }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Không có kết quả nào.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $paginator->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
