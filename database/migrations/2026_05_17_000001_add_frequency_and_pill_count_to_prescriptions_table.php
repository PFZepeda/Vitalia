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
        Schema::table('prescriptions', function (Blueprint $table) {
            if (!Schema::hasColumn('prescriptions', 'pill_count')) {
                $table->unsignedTinyInteger('pill_count')->nullable()->after('dose_unit');
            }

            if (!Schema::hasColumn('prescriptions', 'frequency_hours')) {
                $table->unsignedTinyInteger('frequency_hours')->nullable()->after('administration_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            if (Schema::hasColumn('prescriptions', 'pill_count')) {
                $table->dropColumn('pill_count');
            }

            if (Schema::hasColumn('prescriptions', 'frequency_hours')) {
                $table->dropColumn('frequency_hours');
            }
        });
    }
};
