<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        \Schema::create('transactions', function ($table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('driver_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('description')->nullable();
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
        \Schema::drop('transactions');
    }
}
