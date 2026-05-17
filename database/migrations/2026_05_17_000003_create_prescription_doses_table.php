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
        Schema::create('prescription_doses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->constrained('prescriptions')->cascadeOnDelete();
            $table->dateTime('scheduled_at');
            $table->string('status', 16)->default('pending');
            $table->dateTime('taken_at')->nullable();
            $table->dateTime('missed_at')->nullable();
            $table->string('miss_reason', 64)->nullable();
            $table->string('miss_other', 255)->nullable();
            $table->dateTime('reminder_15_sent_at')->nullable();
            $table->dateTime('reminder_5_sent_at')->nullable();
            $table->dateTime('reminder_late_sent_at')->nullable();
            $table->timestamps();

            $table->unique(['prescription_id', 'scheduled_at']);
            $table->index(['status', 'scheduled_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_doses');
    }
};
