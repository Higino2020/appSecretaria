<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;
    public function funcionario(){
        return $this->belongsTo(Funcionario::class,'funcionario_id','id');
    }
}
