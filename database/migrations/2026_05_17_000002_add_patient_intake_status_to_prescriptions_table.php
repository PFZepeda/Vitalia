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
            if (!Schema::hasColumn('prescriptions', 'last_status')) {
                $table->string('last_status')->nullable()->after('frequency_hours');
            }

            if (!Schema::hasColumn('prescriptions', 'last_taken_at')) {
                $table->timestamp('last_taken_at')->nullable()->after('last_status');
            }

            if (!Schema::hasColumn('prescriptions', 'last_missed_at')) {
                $table->timestamp('last_missed_at')->nullable()->after('last_taken_at');
            }

            if (!Schema::hasColumn('prescriptions', 'last_miss_reason')) {
                $table->string('last_miss_reason', 64)->nullable()->after('last_missed_at');
            }

            if (!Schema::hasColumn('prescriptions', 'last_miss_other')) {
                $table->string('last_miss_other', 255)->nullable()->after('last_miss_reason');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            if (Schema::hasColumn('prescriptions', 'last_miss_other')) {
                $table->dropColumn('last_miss_other');
            }

            if (Schema::hasColumn('prescriptions', 'last_miss_reason')) {
                $table->dropColumn('last_miss_reason');
            }

            if (Schema::hasColumn('prescriptions', 'last_missed_at')) {
                $table->dropColumn('last_missed_at');
            }

            if (Schema::hasColumn('prescriptions', 'last_taken_at')) {
                $table->dropColumn('last_taken_at');
            }

            if (Schema::hasColumn('prescriptions', 'last_status')) {
                $table->dropColumn('last_status');
            }
        });
    }
};
