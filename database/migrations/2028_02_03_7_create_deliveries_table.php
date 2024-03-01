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
            $table->foreignId('orderline_id')->constrained('orderlines')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->date('delivery_date')->default(DB::raw('CURRENT_DATE'));
            $table->string('delivery_time')->default(DB::raw('CURRENT_TIME'));
            $table->foreignId('delivery_status')->constrained('delivery_statuses')->default(1);
            $table->string('delivery_address');
            $table->string('map_reference')->nullable();
            $table->string('special_instruction')->nullable();
            // $table->integer('delivery_fee')->nullable()->default(10);
            $table->string('date_delivered')->nullable();
            $table->boolean('is_archived')->default(1);
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
