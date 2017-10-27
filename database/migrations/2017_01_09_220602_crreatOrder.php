<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrreatOrder extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \Schema::create('orders', function ($table) {
            $table->engine = 'InnoDB';

            $table->increments('id');


            $table->string('client_id')->nullable();
            $table->string('client_longitude')->nullable();
            $table->string('client_latitude')->nullable();

            $table->string('driver_id')->nullable();
            $table->string('driver_longitude')->nullable();
            $table->string('driver_latitude')->nullable();

            $table->string('description')->nullable();
            $table->string('amount')->nullable();

            $table->string('receiver_phone')->nullable();
            $table->string('receiver_name')->nullable();

            $table->string('from_latitude')->nullable();
            $table->string('from_longitude')->nullable();
            $table->string('from_address')->nullable();

            $table->string('to_latitude')->nullable();
            $table->string('to_longitude')->nullable();
            $table->string('to_address')->nullable();

            $table->string('status')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();

            $table->string('trip_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        \Schema::drop('orders');
    }

}
