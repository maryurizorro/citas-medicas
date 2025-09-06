<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->foreignId('medico_id')->nullable()->constrained('medicos')->onDelete('cascade');
            $table->foreignId('paciente_id')->nullable()->constrained('pacientes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['medico_id']);
            $table->dropForeign(['paciente_id']);
            $table->dropColumn(['medico_id', 'paciente_id']);
        });
    }
};

