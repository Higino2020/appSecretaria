<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projecto extends Model
{
    use HasFactory;
    public function funcionario(){
        return $this->belongsTo(Funcionario::class,'responsavel','id');
    }
}
