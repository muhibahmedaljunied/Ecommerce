<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemovePriceFromTemporales extends Migration
{
    public function up()
    {
        if (Schema::hasTable('temporales') && Schema::hasColumn('temporales', 'price')) {
            try {
                // Attempt to drop the column using the Schema builder (may require doctrine/dbal on some drivers)
                Schema::table('temporales', function (Blueprint $table) {
                    $table->dropColumn('price');
                });
            } catch (\Throwable $e) {
                // If the Schema builder cannot drop the column (e.g., in some SQLite cases without DBAL),
                // attempt to run a raw ALTER statement for MySQL-compatible databases. If that also fails,
                // swallow the error to keep migrations idempotent across environments.
                try {
                    DB::statement('ALTER TABLE temporales DROP COLUMN price');
                } catch (\Throwable $inner) {
                    // Best-effort: continue without failing the migration
                    \Log::warning('Could not drop price column from temporales: ' . $inner->getMessage());
                }
            }
        }
    }

    public function down()
    {
        if (Schema::hasTable('temporales') && !Schema::hasColumn('temporales', 'price')) {
            Schema::table('temporales', function (Blueprint $table) {
                $table->decimal('price', 10, 2)->nullable();
            });
        }
    }
}
