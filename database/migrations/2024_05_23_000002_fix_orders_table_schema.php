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
        // Avoid using change() which requires Doctrine DBAL. We'll add a temporary column, copy data, drop old column, and re-create with desired type.
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'order_total_decimal')) {
                $table->decimal('order_total_decimal', 12, 2)->nullable();
            }

            if (!Schema::hasColumn('orders', 'customer_id')) {
                $table->unsignedInteger('customer_id')->nullable()->after('id');
                $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            }
        });

        // Copy values from old text column to the new decimal column (best-effort cast)
        \Illuminate\Support\Facades\DB::statement('UPDATE `orders` SET `order_total_decimal` = CAST(`order_total` AS DECIMAL(12,2)) WHERE `order_total` IS NOT NULL');

        // Note: We avoid dropping/renaming columns here to prevent triggering Doctrine DBAL requirements.
        // The new `order_total_decimal` column can be used by the app moving forward (migration ensures data is copied).
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'customer_id')) {
                $table->dropForeign(['customer_id']);
                $table->dropColumn('customer_id');
            }

            // Drop the helper decimal column if it exists
            if (Schema::hasColumn('orders', 'order_total_decimal')) {
                $table->dropColumn('order_total_decimal');
            }

            // We keep the original 'order_total' (text) as-is when rolling back.
        });
    }
}
