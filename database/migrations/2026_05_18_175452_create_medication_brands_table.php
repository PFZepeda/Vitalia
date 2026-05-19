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
        Schema::create('medication_brands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_item_id')->constrained('prescription_items')->cascadeOnDelete();
            $table->string('brand_name'); // Patente (Advil, Tempra, etc.)
            $table->decimal('dose', 8, 2); // Dosis de la presentación (400)
            $table->string('dose_unit'); // Unidad (mg)
            $table->unsignedInteger('pills_per_box'); // Pastillas por caja (10, 12, etc.)
            $table->boolean('is_suggested')->default(false); // Si es la patente sugerida
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_brands');
    }
};
