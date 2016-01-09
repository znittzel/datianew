<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('context');
            $table->string('reg_number')->nullable();
            $table->text('accessories')->nullable();
            $table->string('place')->nullable();
            $table->string('status');
            $table->tinyInteger('prio');
            $table->string('sign');
            $table->integer('event_id');
            $table->string('estimated_time');
            $table->dateTime('booked_at');
            $table->dateTime('pickup_at');
            $table->dateTime('finished_at');
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
        Schema::drop('orders');
    }
}
