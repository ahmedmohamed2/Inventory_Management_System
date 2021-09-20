<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->id();
            $table->integer("quantity");
            $table->integer("price");
            $table->double("tax", 10, 2);
            $table->unsignedBigInteger("order_id");
            $table->unsignedBigInteger("product_id");
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate("cascade")->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate("cascade")->onDelete('cascade');
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
        Schema::dropIfExists('orders_products');
    }
}
