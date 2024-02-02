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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->date('delivery_date')->default(DB::raw('CURRENT_DATE'));
            $table->string('delivery_time')->default(DB::raw('CURRENT_TIME'));
            $table->string('delivery_status')->default('In progress');
            $table->string('delivery_address');
            $table->string('map_reference')->nullable();
            $table->string('special_instruction')->nullable();
            $table->string('date_delivered')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
};
