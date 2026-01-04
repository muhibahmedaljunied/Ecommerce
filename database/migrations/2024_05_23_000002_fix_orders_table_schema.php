<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixOrdersTableSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Change order_total to decimal for proper money handling
            // Note: This requires the doctrine/dbal dependency
            $table->decimal('order_total', 12, 2)->change();

            // Add the missing customer_id link to users
            // Using nullable() to prevent errors if the table already has data
            $table->unsignedInteger('customer_id')->nullable()->after('id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');

            $table->text('order_total')->change();
        });
    }
}
