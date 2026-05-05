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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->unique();
            $table->string('phone_country_code', 8)->nullable();
            $table->string('phone_local', 32)->nullable();
            $table->string('security_question')->nullable();
            $table->string('security_answer')->nullable();
            $table->string('sex', 16)->nullable();
            $table->date('birth_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['phone']);
            $table->dropColumn([
                'phone',
                'phone_country_code',
                'phone_local',
                'security_question',
                'security_answer',
                'sex',
                'birth_date',
            ]);
        });
    }
};
