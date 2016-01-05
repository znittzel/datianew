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
            $table->integer('order_id')->uniqid();
            $table->integer('customer_id');
            $table->integer('user_id');;
            $table->text('context');
            $table->string('type')->nullable();
            $table->text('accessories')->nullable();
            $table->string('password')->nullable();
            $table->string('box')->nullable();
            $table->string('status');
            $table->tinyInt('prio');
            $table->string('sign');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('user_id')->references('id')->on('users');
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
