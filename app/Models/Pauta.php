<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pauta extends Model
{
    use HasFactory;
    public function estudante(){
        return $this->belongsTo(estudante::class,'estudante_id','id');
    }
    public function disciplina(){
        return $this->belongsTo(disciplina::class,'disciplina_id','id');
    }
    public function funcionario(){
        return $this->belongsTo(Funcionario::class,'funcionario_id','id');
    }
}
