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
        // Limpiamos prescription_items para que solo sea tabla de referencia de medicamentos
        Schema::table('prescription_items', function (Blueprint $table) {
            // Remover solo las columnas que existen
            $columnsToRemove = [];
            if (Schema::hasColumn('prescription_items', 'dose')) {
                $columnsToRemove[] = 'dose';
            }
            if (Schema::hasColumn('prescription_items', 'dose_unit')) {
                $columnsToRemove[] = 'dose_unit';
            }
            if (Schema::hasColumn('prescription_items', 'observations')) {
                $columnsToRemove[] = 'observations';
            }
            
            if (!empty($columnsToRemove)) {
                $table->dropColumn($columnsToRemove);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescription_items', function (Blueprint $table) {
            $table->decimal('dose', 8, 2);
            $table->string('dose_unit');
            $table->text('observations')->nullable();
        });
    }
};
