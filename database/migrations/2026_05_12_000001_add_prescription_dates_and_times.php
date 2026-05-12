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
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('administration_time')->nullable();
        });

        Schema::table('prescription_items', function (Blueprint $table) {
            $table->dropColumn('frequency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date', 'administration_time']);
        });

        Schema::table('prescription_items', function (Blueprint $table) {
            $table->string('frequency');
        });
    }
};
