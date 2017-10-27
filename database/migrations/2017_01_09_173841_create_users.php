<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \Schema::create('users', function ($table) {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('image')->nullable();
            $table->string('f_name')->nullable();
            $table->string('token')->nullable();
            $table->string('token_type')->nullable();
            $table->string('active_token')->nullable();
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
        \Schema::drop('users');
    }

}
