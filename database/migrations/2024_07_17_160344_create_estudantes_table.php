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
        Schema::create('estudantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('sobrenome');
            $table->string('n_bilhete')->unique();
            $table->string('telefone')->unique();
            $table->string('bilhete');
            $table->string('gmail');
            $table->string('certificado');
            $table->string('curso')->unique();
            $table->string('matricula')->unique();
            $table->string('ano_academico');
            $table->foreignId('funcionario_id')->constrained('funcionarios');
            $table->string('data');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudantes');
    }
};
