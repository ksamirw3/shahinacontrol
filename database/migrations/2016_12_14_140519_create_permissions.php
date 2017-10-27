<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \Schema::create('permissions', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('action');
            $table->string('model');
            $table->string('label');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        \Schema::drop('permissions');
    }

}
