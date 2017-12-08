<?php

namespace App\Http\Controllers;

use App\Movimentacoes;
use Illuminate\Http\Request;
use App\Paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Gate;

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

        if (Gate::allows('accesso-movimentacoes', Auth::user()->type)) {
            $movimentacoes = Movimentacoes::where('paciente_id', '=', $id)
                ->where('type_user','=',Auth::user()->type)
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $movimentacoes = Movimentacoes::where('paciente_id', '=', $id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pacientes.paciente', compact('paciente','movimentacoes'));
    }

    public function newMovimentation(Request $request, $id){
       $data = [
            'paciente_id' => $id,
            'type_user' => Auth::user()->type,
            'turno' => $request['turnos'],
            'descricao' => $request['descricao'],
        ];

        return Movimentacoes::create($data);
    }

}
