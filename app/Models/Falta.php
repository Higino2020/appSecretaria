<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Falta extends Model
{
    use HasFactory;
    public function estudante(){
        return $this->belongsTo(estudante::class,'estudantes_Id','id');
    }
    public function funcionario(){
        return $this->belongsTo(Funcionario::class,'funcionario_Id','id');
    }
}
