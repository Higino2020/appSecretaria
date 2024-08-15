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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->string('data_matricula');
            $table->string('ano_lectivo');
            $table->foreignId('classe_id')->constrained('Classes');
            $table->foreignId('estudante_Id')->constrained('estudantes');
            $table->foreignId('professor_id')->constrained('Funcionarios');
            $table->foreignId('turma_Id')->constrained('turmas');
            $table->foreignId('funcionario_Id')->constrained('Funcionarios');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
