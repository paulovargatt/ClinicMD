<?php

namespace App\Http\Controllers;

use App\Movimentacoes;
use Illuminate\Http\Request;
use App\Paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Gate;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
use Validator;

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
        $city = DB::table('pacientes')
                ->join('cidades', 'pacientes.city_id', '=', 'cidades.id')
                ->select('pacientes.id','cidades.uf', 'cidades.nome as city','cidades.id as idcity')
                ->where('pacientes.id', $id)
                ->get()->toArray();
        return view('pacientes.paciente', compact('paciente','city'));
    }

    public function novoPaciente(){
        return view('pacientes.novo');
    }
    public function createPaciente(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            $data = [
                'sexo' => $request['sexo'],
                'nome' => $request['name'],
                'est_civil' => $request['est'],
                'nascimento' => Carbon::createFromFormat('d/m/Y', $request->get('nascimento')),
                'prontuario' => $request['prontuario'],
                'convenio' => $request['convenio'],
                'uf' => $request['uf'],
                'city_id' => $request['cidade'],
                'identidade' => $request['identidade'],
                'cpf' => $request['cpf'],
                'email' => $request['email'],
                'telefones' => $request['fones'],
                'logradouro' => $request['logradouro'],
                'bairro' => $request['bairro'],
                'complemento' => $request['complemento'],
                'cep' => $request['cep']
            ];
            return Paciente::create($data);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function updatePaciente(Request $request, $id){
        $paciente = Paciente::find($id);
        $paciente->sexo = $request->get('sexo');
        $paciente->nome = $request->get('name');
        $paciente->est_civil = $request->get('est');
        $paciente->nascimento =  Carbon::createFromFormat('d/m/Y', $request->get('nascimento'));
        $paciente->prontuario = $request->get('prontuario');
        $paciente->matricula = $request->get('matricula');
        $paciente->convenio = $request->get('convenio');
        $paciente->uf = $request->get('uf');
        $paciente->city_id = $request->get('cidade');
        $paciente->identidade = $request->get('identidade');
        $paciente->cpf = $request->get('cpf');
        $paciente->email = $request->get('email');
        $paciente->telefones = $request->get('fones');
        $paciente->logradouro = $request->get('logradouro');
        $paciente->bairro = $request->get('bairro');
        $paciente->complemento = $request->get('complemento');
        $paciente->cep = $request->get('cep');
        $paciente->update();
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

    public function editMovimentation(Request $request, $id){
        $data = Movimentacoes::find($id);
        $data->turno = $request->get('turnos');
        $data->descricao = $request->get('descricao');
        $data->update();
        $ret = array('status' => 'success',
                     'msg' => 'Updated');
        return response()->json($ret);
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
                }elseif($movimentacoes->type_user == 2){
                    return "Médica";
                }else{
                    return "Administração";
                }
            })
            ->addColumn('action', function ($movimentacoes){
                if($movimentacoes->type_user == Auth::user()->type){
                return
                    '<a onclick="editMovi('. $movimentacoes->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> </a> ' .
                    '<a onclick="deleteMovi(' . $movimentacoes->id . ')" data-toggle="confirmation" data-popout="true" data-placement="left" data-original-title="Deletar ?" class="btn btn-danger btn-xs delete-movimentacao"><i class="glyphicon glyphicon-trash"></i></a>';
                }
                })
            ->rawColumns(['turno','action'])
            ->make(true);
    }

    public function deleteMovimentation($id){

        return Movimentacoes::destroy($id);
    }

    public function getMovimentation($id){
       $data = Movimentacoes::find($id);

       return $data;
    }

    public function fotoPaciente(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->passes()) {
            $input = $request->all();
            $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
            $foto = $input['image'];
            $request->image->move(public_path('images/pacientes'), $foto);

            $paciente = Paciente::find($id);
            $fotoAtual = $paciente->foto;
            if($fotoAtual){
                if(file_exists(public_path('images/pacientes/'.$fotoAtual))){
                    unlink(public_path('images/pacientes/'.$fotoAtual));
                }
            }
            $paciente->foto = $foto;
            $paciente->update();
            return response()->json(['success'=>'done']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function deletePaciente($id){
        $paciente = Paciente::find($id);
        $paciente->delete();

        return redirect('pacientes');
    }

    public function deletadosPaciente(){
        $deletados = Paciente::onlyTrashed()->get();
        return view('pacientes.deletados', compact('deletados'));
    }

    public function restaurePaciente(Request $request, $id){
        Paciente::where('id',$id)
            ->restore();
        return back();
    }

}
