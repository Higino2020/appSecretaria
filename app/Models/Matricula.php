<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    public function turma(){
        return $this->belongsTo(Turma::class,'turma_Id','id');
    }
    public function estudante(){
        return $this->belongsTo(estudante::class,'estudante_Id','id');
    }
    public function funcionario(){
        return $this->belongsTo(Funcionario::class,'funcionario_Id','id');
    }
}
