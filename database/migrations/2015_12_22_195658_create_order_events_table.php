<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_events', function (Blueprint $table) {
            $table->increments('order_event_id');
            $table->integer('order_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('comment');
            $table->string('sign');
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
        Schema::drop('order_events');
    }
}
