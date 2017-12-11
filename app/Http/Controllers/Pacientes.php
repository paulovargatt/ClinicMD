<?php

namespace App\Http\Controllers;

use App\Movimentacoes;
use Illuminate\Http\Request;
use App\Paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Gate;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

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
        //SE É Tecnica quem esta acessando (TYPE = 1):

        return view('pacientes.paciente', compact('paciente'));
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

    public function jsonDataPacientes($id)
    {
        $paciente = Paciente::find($id);
        //SE É Tecnica quem esta acessando (TYPE = 1):
        if (Gate::allows('accesso-movimentacoes', Auth::user()->type)) {
            $movimentacoes = Movimentacoes::where('paciente_id', '=', $id)
                ->where('type_user', '=', Auth::user()->type)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $movimentacoes = Movimentacoes::where('paciente_id', '=', $id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return DataTables::of($movimentacoes)
            ->addColumn('turno', function ($movimentacoes) {
                return
                   '<span class="label label-primary ' . $movimentacoes->turno . '">' . $movimentacoes->turno . '</span>';
            })
            ->addColumn('created_at', function ($movimentacoes) {
                return
                $movimentacoes->created_at->format('d/m/Y') . ' - ' . $movimentacoes->created_at->subHour(2)->format('H:i');
            })
            ->addColumn('type_user', function ($movimentacoes) {
                if($movimentacoes->type_user == 1){
                    return "Enfermagem";
                }if($movimentacoes->type_user == 2){
                    return "Médica";
                }else{
                    "Administração";
                }
            })
            ->addColumn('action', function ($movimentacoes){
                return
                    '<a onclick="editForm('. $movimentacoes->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> </a> ' .
                    '<a onclick="deleteData(' . $movimentacoes->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->rawColumns(['turno','action'])
            ->make(true);
    }

}
