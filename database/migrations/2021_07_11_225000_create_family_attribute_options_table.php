<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyAttributeOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_attribute_options', function (Blueprint $table) {

            $table->Increments('id');
            // -------------------------------------------------------------------------------------------
            // $table->unsignedInteger('attribute_family_id');
            // $table->foreign('attribute_family_id','att_fam')
            // ->references('id')->on('product_family_attributes')->onDelete('cascade');

            $table->unsignedInteger('attribute_family_mapping_id');
            $table->foreign('attribute_family_mapping_id')->references('id')->on('attribute_family_mappings')->onDelete('cascade');


            $table->unsignedInteger('product_family_attribute_id');
            $table->foreign('product_family_attribute_id')->references('id')->on('product_family_attributes')->onDelete('cascade');

            // -------------------------------------------------------------------------------------------
            $table->unsignedInteger('attribute_option_id');
            $table->foreign('attribute_option_id')->references('id')->on('attribute_options')->onDelete('cascade');


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
        Schema::dropIfExists('family_attribute_options');
    }
}
