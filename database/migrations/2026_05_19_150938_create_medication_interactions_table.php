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
        Schema::create('medication_interactions', function (Blueprint $table) {
            $table->id();
            $table->string('medication_name_1');
            $table->string('medication_name_2');
            $table->text('interaction_message');
            $table->string('severity')->default('warning');
            $table->unique(['medication_name_1', 'medication_name_2'], 'med_inter_u');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_interactions');
    }
};
