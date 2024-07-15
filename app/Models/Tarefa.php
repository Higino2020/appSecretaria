<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;
    public function funcionario(){
        return $this->belongsTo(Funcionario::class,'responsavel','id');
    }
    public function projecto(){
        return $this->belongsTo(Projecto::class,'projeto_id','id');
    }
}
