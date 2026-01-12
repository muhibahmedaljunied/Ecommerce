<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixProductsColumnName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Avoid using renameColumn (requires Doctrine DBAL). Instead add a new column and copy values.
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'name')) {
                $table->string('name')->nullable();
            }
        });

        \Illuminate\Support\Facades\DB::statement('UPDATE `products` SET `name` = `text` WHERE `text` IS NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
}
