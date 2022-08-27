<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no')->nullable();
            $table->string('clientName');
            $table->string('clientPhone');
            $table->string('email')->nullable();
            $table->string('status')->default('Pending');
            $table->string('shipping_address');
            $table->longText('notes');
            $table->integer('shipping_amount')->default(0);
            $table->string('payment_type')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->foreign('updated_by_id', 'updated_by_fk_7211860')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
