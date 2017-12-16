<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Paciente extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome','prontuario','nascimento','foto','convenio','matricula','sexo','est_civil','indicacao','identidade','cpf','email','logradouro','complemento','bairro','city_id','uf','cep','telefones'];

    protected $dates = [
        'cadastro',
        'nascimento',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
