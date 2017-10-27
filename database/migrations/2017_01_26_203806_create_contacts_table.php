<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('contacts', function ($table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->string('message')->nullable();
            $table->integer('driver_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('seen')->default(0);
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
