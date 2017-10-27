<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \Schema::create('reviews', function ($table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->string('comment')->nullable();
            $table->integer('rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        \Schema::drop('reviews');
    }

}
