<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggerTrTinhDiemTichLuy extends Migration
{
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER tr_tinh_diem_tich_luy AFTER INSERT ON HoaDon
            FOR EACH ROW
            BEGIN
                DECLARE tong_tien DECIMAL(10, 2);

                SELECT SUM(ct.so_luong * t.gia_ban)
                INTO tong_tien
                FROM ChiTietHD ct
                INNER JOIN Thuoc t ON ct.ma_Thuoc = t.ma_thuoc
                WHERE ct.ma_HD = NEW.ma_HD;

                UPDATE KhachHang
                SET diem_tich = diem_tich + IFNULL(FLOOR(tong_tien / 50000), 0)
                WHERE KhachHang.ma_KH = NEW.ma_KH;
            END;
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_tinh_diem_tich_luy');
    }
}
