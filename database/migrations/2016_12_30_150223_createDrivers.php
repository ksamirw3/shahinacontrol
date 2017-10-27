<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \Schema::create('drivers', function ($table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            
            $table->string('username')->unique();
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->string('date_r')->nullable();
            $table->string('presonal_image')->nullable();
            $table->string('email')->unique();
            $table->string('uploads_ids')->nullable();
            $table->string('note')->nullable();
            $table->string('phone')->nullable();
            $table->string('year_model')->nullable();
            $table->string('nationality')->nullable();
            $table->string('date_expiration')->nullable();
            $table->string('single_line')->nullable();
            $table->string('insurance_number')->nullable();
            $table->string('car_authorization')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_IBAN')->nullable();
            $table->string('plate_no')->nullable();
            $table->string('finger_print')->nullable();
            $table->string('driver_signature')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('national_id')->nullable();
            $table->string('car_size')->nullable();
            $table->string('token')->nullable();
            $table->string('token_type')->nullable();
           
            $table->tinyInteger('is_connect')->default(0);
            $table->tinyInteger('is_busy')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
           				
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        \Schema::drop('drivers');
    }

}
