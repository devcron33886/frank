<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_7211622')->references('id')->on('categories');
            $table->string('name');
            $table->string('qty');
            $table->integer('price');
            $table->string('measure');
            $table->string('min_stock')->nullable();
            $table->string('status')->nullable();
            $table->longText('description')->nullable();
            $table->integer('discount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
