<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {

            $table->Increments('id');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            //  ---------------------------------------------------------------------------------------------
            // ---------------------------------------------------------------------------------
            // $table->unsignedInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // // ---------------------------------------------------------------------------------
            // $table->unsignedInteger('size_id');
            // $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            // // ---------------------------------------------------------------------------------
            // $table->unsignedInteger('country_id');
            // $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            // // -----------------------------------------------------------------------------------

            // $table->unsignedInteger('color_id');
            // $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            // // -----------------------------------------------------------------------------------

            // $table->unsignedInteger('brand_id');
            // $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            // // -----------------------------------------------------------------------------------

            // $table->unsignedInteger('age_id');
            // $table->foreign('age_id')->references('id')->on('ages')->onDelete('cascade');

            // -----------------------------------------------------------------------------------
            $table->integer('qty');
            $table->decimal('price');
            $table->decimal('discount');
            $table->string('image')->nullable();
            // $table->string('new')->default('no');
            // $table->string('featured')->default('no');

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
        Schema::dropIfExists('product_attributes');
    }
}
