<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("product_name")->unique();;
            $table->text("product_description");
            $table->integer("product_quantity");
            $table->double("product_price", 10, 2);
            $table->double("product_tax", 4, 2);
            $table->string("product_status", 1);
            $table->unsignedBigInteger("unit_id");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("brand_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate("cascade")->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate("cascade")->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate("cascade")->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate("cascade")->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
