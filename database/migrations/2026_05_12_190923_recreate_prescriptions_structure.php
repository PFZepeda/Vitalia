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
        // Agregar solo los campos que faltan a prescriptions
        Schema::table('prescriptions', function (Blueprint $table) {
            // Verificar si la columna ya existe
            if (!Schema::hasColumn('prescriptions', 'prescription_item_id')) {
                $table->foreignId('prescription_item_id')->nullable()->after('patient_id')->constrained('prescription_items')->nullOnDelete();
            }
            
            if (!Schema::hasColumn('prescriptions', 'dose')) {
                $table->decimal('dose', 8, 2)->nullable()->after('prescription_item_id');
            }
            
            if (!Schema::hasColumn('prescriptions', 'dose_unit')) {
                $table->string('dose_unit')->nullable()->after('dose');
            }
            
            if (!Schema::hasColumn('prescriptions', 'observations')) {
                $table->text('observations')->nullable()->after('dose_unit');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['prescription_item_id_foreign']);
            $table->dropColumnIfExists(['prescription_item_id', 'dose', 'dose_unit', 'observations']);
        });
    }
};
