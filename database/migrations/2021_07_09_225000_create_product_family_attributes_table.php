<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFamilyAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_family_attributes', function (Blueprint $table) {

            $table->Increments('id');
            // -------------------------------------------------------------------------------------------
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // -------------------------------------------------------------------------------------------
            $table->unsignedInteger('attribute_family_mapping_id');
            $table->foreign('attribute_family_mapping_id','att_fam')
            ->references('id')->on('attribute_family_mappings')->onDelete('cascade');
          
            $table->integer('qty');
            $table->decimal('price');
            $table->decimal('discount')->default(0);
            $table->string('image')->nullable();
            $table->string('new')->default('yes');
            $table->string('featured')->default('no');
            $table->string('description')->nullable();


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
        Schema::dropIfExists('product_family_attributes');
    }
}
