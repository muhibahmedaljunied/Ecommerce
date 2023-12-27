<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_values', function (Blueprint $table) {

            $table->Increments('id');
            // -------------------------------------------------------------------------------------------
            $table->string('name');
            // -------------------------------------------------------------------------------------------
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // -------------------------------------------------------------------------------------------
            $table->unsignedInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            // -----------------------------------------------------------------------------------
            $table->integer('qty');
            $table->decimal('price');
            $table->decimal('discount');
            $table->string('image')->nullable();
            $table->string('new')->default('no');
            $table->string('featured')->default('no');

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
