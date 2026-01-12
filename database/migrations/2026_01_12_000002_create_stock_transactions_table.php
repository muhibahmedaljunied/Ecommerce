<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_family_attribute_id');
            $table->foreign('product_family_attribute_id')->references('id')->on('product_family_attributes')->onDelete('cascade');
            $table->integer('change'); // positive for additions, negative for reductions
            $table->string('type')->nullable(); // e.g., 'sale', 'adjustment', 'purchase', 'return'
            $table->unsignedInteger('reference_id')->nullable();
            $table->string('reference_type')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('stock_transactions');
    }
}
