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

            $table->Increments('id');
            // ---------------------------------------------------------------------------
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('products');
            // ------------------------------------------------------------------------------
            $table->integer('rank');
            // ------------------------------------
            $table->string('text');
            $table->string('status')->nullable();
            // --------------------------------------------------------------------------------------------------------
            // $table->unsignedInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->unsignedInteger('size_id');
            // $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            // $table->unsignedInteger('country_id');
            // $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            // $table->integer('qty');
            // $table->decimal('price');
            // $table->decimal('discount');
            // $table->string('image')->nullable();
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
