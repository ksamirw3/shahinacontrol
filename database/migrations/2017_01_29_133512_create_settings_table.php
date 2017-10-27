<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('settings', function ($table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('place_holder')->nullable();
            $table->string('icon')->nullable();
            $table->string('label')->nullable();
            $table->string('value')->nullable();
            $table->string('required')->nullable();
            $table->string('for_now')->nullable();
            $table->string('class')->nullable();
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
        \Schema::drop('contacts');
    }
}
