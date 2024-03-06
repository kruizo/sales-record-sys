<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
                    CREATE TRIGGER delete_empty_order AFTER DELETE ON orderlines
                    FOR EACH ROW
                    BEGIN
                        DECLARE order_count INT;
                        
                        SELECT COUNT(*) INTO order_count FROM orderlines WHERE order_id = OLD.order_id;

                        IF order_count = 0 THEN
                            DELETE FROM orders WHERE id = OLD.order_id;
                        END IF;
                    END;
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS delete_empty_order');
    }
};
