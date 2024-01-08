<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')
            ->onDelete('cascade');
            $table->unsignedInteger('product_family_attribute_id');
            $table->foreign('product_family_attribute_id')->references('id')->on('product_family_attributes')
            ->onDelete('cascade');
            $table->integer('quantity');
            $table->float('price')->nullable();
            $table->float('total')->nullable();
            $table->timestamps();
        });
    }


    // Schema::create('invoices', function (Blueprint $table) {
    //     $table->increments('id');

    //     # Data obtained through the API response of PayPal
    //     $table->string('customer_email')->nullable();
    //     $table->string('customer_id')->nullable();
    //     $table->string('country_code')->nullable();
    //     $table->string('payment_id')->nullable();
    //     $table->string('currency')->nullable();
    //     $table->string('payment_status')->nullable();
    //     $table->double('price', 2);
    //     $table->timestamps();
    // });

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
