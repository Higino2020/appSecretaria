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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_tarefa');
            $table->text('descricao');
            $table->date('data_limite');
            $table->string('status');
            $table->string('prioridade');
            $table->foreignId('responsavel')->constrained('funcionarios');
            $table->foreignId('projeto_id')->constrained('projectos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
