<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Paciente extends Model
{



    protected $dates = [
        'cadastro',
        'nascimento',
        'created_at',
        'updated_at',
    ];

}
