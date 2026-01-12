<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlertQtyToProductFamilyAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_family_attributes', function (Blueprint $table) {
            $table->integer('alert_qty')->default(0)->after('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_family_attributes', function (Blueprint $table) {
            $table->dropColumn('alert_qty');
        });
    }
}
