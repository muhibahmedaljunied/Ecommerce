<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporales', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('product_family_attribute_id')->unsigned()->nullable();
            $table->foreign('product_family_attribute_id')->references('id')->on('product_family_attributes')
            ->onDelete('cascade');
            $table->integer('qty');
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('temporales');
    }
}
