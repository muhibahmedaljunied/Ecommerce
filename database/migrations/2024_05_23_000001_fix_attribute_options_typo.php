<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixAttributeOptionsTypo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Avoid using renameColumn which requires Doctrine DBAL. Instead: add new column, copy data, drop old column.
        Schema::table('attribute_options', function (Blueprint $table) {
            if (!Schema::hasColumn('attribute_options', 'value')) {
                $table->string('value')->nullable();
            }
        });

        // Copy existing values from 'alue' to 'value' and drop 'alue'
        \Illuminate\Support\Facades\DB::statement('UPDATE `attribute_options` SET `value` = `alue` WHERE `alue` IS NOT NULL');

        // Do not drop the old `alue` column here to avoid requiring Doctrine DBAL
        // and to keep migrations compatible with SQLite in test environments.
        // If you want to remove `alue`, do so in a separate deployment step when
        // Doctrine DBAL is available on the target platform.

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Add back 'alue' and copy data from 'value', then drop 'value'
        Schema::table('attribute_options', function (Blueprint $table) {
            if (!Schema::hasColumn('attribute_options', 'alue')) {
                $table->string('alue')->nullable();
            }
        });

        \Illuminate\Support\Facades\DB::statement('UPDATE `attribute_options` SET `alue` = `value` WHERE `value` IS NOT NULL');

        // Do not drop the `value` column here to avoid requiring Doctrine DBAL
        // and to keep migrations compatible with SQLite in test environments.
        // If you want to remove `value`, do so in a separate deployment step when
        // Doctrine DBAL is available on the target platform.

    }
}
