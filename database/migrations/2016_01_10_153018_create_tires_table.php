<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('reg_number');
            $table->string('position');
            $table->integer('number_of_tires');
            $table->text('quality');
            $table->string('type');
            $table->dateTime('filed_at');
            $table->dateTime('returned_at');
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
        Schema::drop('tires');
    }
}
