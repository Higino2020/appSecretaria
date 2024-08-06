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
            $table->string('genero');
            $table->string('provincia');
            $table->string('naturalidade');
            $table->string('afiliacao');
            $table->string('foto');
            $table->string('n_bilhete')->nullable();
            $table->string('telefone')->unique();
            $table->string('bilhete')->nullable();
            $table->string('certificado')->nullable();
            $table->string('data');
            $table->string('status')->nullable();
            $table->foreignId('funcionario_id')->constrained('funcionarios');
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
