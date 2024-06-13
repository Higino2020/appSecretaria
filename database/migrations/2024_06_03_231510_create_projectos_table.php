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
        Schema::create('projectos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_projeto');
            $table->text('descricao');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->string('status');
            $table->foreignId('responsavel')->constrained('funcionarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projectos');
    }
};
