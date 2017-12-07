<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacoes extends Model
{
    protected $fillable = ['paciente_id', 'type_user','turno','descricao'];


}
