<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('product_name');
            $table->text('product_description');
            $table->string('product_url');
            $table->unsignedInteger('category_id');
            $table->integer('product_quantity');
            // SL number of user rate product
            $table->integer('product_rate')->default(0);
            $table->float('product_price',8,2);
            $table->tinyInteger('product_condition')->default(1);
            $table->string('product_keyword');
            $table->string('product_image');
            $table->string('product_content');
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('categories');
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
