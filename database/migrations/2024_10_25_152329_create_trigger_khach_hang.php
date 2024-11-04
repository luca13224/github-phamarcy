<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggerKhachHang extends Migration
{
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER tg_KtrakhiThemKhachHang
        BEFORE INSERT ON KhachHang
        FOR EACH ROW
        BEGIN
            IF EXISTS (
                SELECT 1 FROM KhachHang KH 
                WHERE KH.SDT_KH = NEW.SDT_KH
            ) THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Khách hàng đã có trong hệ thống!';
            END IF;
            
            INSERT INTO KhachHang (ma_KH, ten_KH, SDT_KH, gioi_tinh, ngay_sinh, diem_tich)
            VALUES (COALESCE(NEW.ma_KH, (SELECT MAX(ma_KH) + 1 FROM KhachHang)), 
                             NEW.ten_KH, NEW.SDT_KH, NEW.gioi_tinh, NEW.ngay_sinh, NEW.diem_tich);
        END;
        ");
    }

    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS tg_KtrakhiThemKhachHang;");
    }
}
