<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddTriggerTrgGiamSoLuongTon extends Migration
{
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER trg_GiamSoLuongTon
            AFTER INSERT ON ChiTietHD
            FOR EACH ROW
            BEGIN
                DECLARE ma_thuoc INT;
                DECLARE so_luong INT;

                SET ma_thuoc = NEW.ma_Thuoc;
                SET so_luong = NEW.so_luong;

                UPDATE Thuoc
                SET so_luong_ton = so_luong_ton - so_luong
                WHERE ma_thuoc = ma_thuoc;
            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_GiamSoLuongTon');
    }
}
