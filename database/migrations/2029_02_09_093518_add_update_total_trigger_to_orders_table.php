<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                CREATE TRIGGER update_order_total
                AFTER UPDATE ON deliveries
                FOR EACH ROW
                BEGIN
                    IF NEW.delivery_status != 3 AND NEW.is_archived = 0 THEN
                        UPDATE orders
                        SET total = (
                            SELECT SUM(subtotal) 
                            FROM orderlines 
                            WHERE order_id = (
                                SELECT order_id 
                                FROM orderlines 
                                WHERE id = NEW.orderline_id
                            )
                        )
                        WHERE id = (
                            SELECT order_id 
                            FROM orderlines 
                            WHERE id = NEW.orderline_id
                        );
                    END IF;
                END
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_order_total');
    }
};
