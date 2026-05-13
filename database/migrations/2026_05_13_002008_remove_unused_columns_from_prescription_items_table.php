<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prescription_items', function (Blueprint $table) {
            if (Schema::hasColumn('prescription_items', 'prescription_id')) {
                $table->dropForeign(['prescription_id']);
                $table->dropColumn('prescription_id');
            }
            $columnsToDrop = [];
            foreach (['start_date', 'end_date', 'administration_time', 'weekdays'] as $col) {
                if (Schema::hasColumn('prescription_items', $col)) {
                    $columnsToDrop[] = $col;
                }
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescription_items', function (Blueprint $table) {
            // Revert step (simplified since we shouldn't really go back)
        });
    }
};
