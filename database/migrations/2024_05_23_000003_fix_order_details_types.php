<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixOrderDetailsTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Avoid change() (Doctrine DBAL); add helper decimal columns and copy values.
        Schema::table('order_details', function (Blueprint $table) {
            if (!Schema::hasColumn('order_details', 'price_decimal')) {
                $table->decimal('price_decimal', 12, 2)->nullable();
            }
            if (!Schema::hasColumn('order_details', 'total_decimal')) {
                $table->decimal('total_decimal', 12, 2)->nullable();
            }
        });

        \Illuminate\Support\Facades\DB::statement('UPDATE `order_details` SET `price_decimal` = CAST(`price` AS DECIMAL(12,2)) WHERE `price` IS NOT NULL');
        \Illuminate\Support\Facades\DB::statement('UPDATE `order_details` SET `total_decimal` = CAST(`total` AS DECIMAL(12,2)) WHERE `total` IS NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            if (Schema::hasColumn('order_details', 'price_decimal')) {
                $table->dropColumn('price_decimal');
            }
            if (Schema::hasColumn('order_details', 'total_decimal')) {
                $table->dropColumn('total_decimal');
            }
        });
    }
}
