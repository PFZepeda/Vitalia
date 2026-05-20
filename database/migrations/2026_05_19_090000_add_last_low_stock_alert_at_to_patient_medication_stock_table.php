<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('patient_medication_stock', function (Blueprint $table) {
            $table->timestamp('last_low_stock_alert_at')->nullable()->after('current_pills');
        });
    }

    public function down(): void
    {
        Schema::table('patient_medication_stock', function (Blueprint $table) {
            $table->dropColumn('last_low_stock_alert_at');
        });
    }
};
