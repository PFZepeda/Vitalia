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
            $table->date('start_date')->nullable()->after('observations');
            $table->date('end_date')->nullable()->after('start_date');
            $table->time('administration_time')->nullable()->after('end_date');
            $table->string('weekdays')->nullable()->after('administration_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescription_items', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date', 'administration_time', 'weekdays']);
        });
    }
};
