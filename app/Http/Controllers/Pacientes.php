<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use Carbon\Carbon;

class Pacientes extends Controller
{
    public function index()
    {
       $carga = Paciente::paginate(15);
        return view('pacientes.list', compact('carga'));
    }

    public function paciente($id)
    {
        $paciente = Paciente::find($id);
     //   $paciente->nascimento = Carbon::parse()->format('d/m/Y');
        return view('pacientes.paciente', compact('paciente'));
    }
}
