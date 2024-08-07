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
        Schema::create('pautas', function (Blueprint $table) {
            $table->id();
            $table->string('prova1');
            $table->string('prova2');
            $table->string('exame');
            $table->string('final');
            $table->string('periodo')->nullable(false);
            $table->string('status');
            $table->foreignId('estudante_id')->constrained('estudantes');
            $table->foreignId('funcionario_id')->constrained('funcionarios');
            $table->foreignId('disciplina_id')->constrained('disciplinas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pautas');
    }
};
