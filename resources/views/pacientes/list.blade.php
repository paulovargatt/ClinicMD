@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Todos os Pacientes</h1>
@stop

@section('content')
    @foreach($carga as $pacientes)
      <a href="{{url('/paciente/'.$pacientes->id)}}">
       <div class="col-md-3" style="min-height: 275px!important;max-height: 276px;">
           <div class="box box-primary">
            <div class="box-body box-profile">
                 <img class="profile-user-img img-responsive img-circle" style="min-height: 100px;"
                 src="{{$pacientes->foto == "" ? "/images/user.png" : '../images/pacientes/'.$pacientes->foto}}">
                <h4 class="text-center">{{$pacientes->nome}}</h4>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Idade:</b> <span class="pull-right input-small idad">{{$pacientes->nascimento->diffForHumans(null,true)}} </span>
                    </li>
                    <li class="list-group-item">
                        <b>Prontuario</b> <input class="pull-right input-small pront" value="{{$pacientes->prontuario == "" ? "00" : $pacientes->prontuario}}" />
                    </li>

                    <li class="list-group-item">
                        <b>Convenio</b> <input c class="pull-right input-small conv" value="{{$pacientes->convenio == "" ? "#" : $pacientes->convenio}}"/>
                    </li>
                </ul>
            </div>
       </div>
    </div>
      </a>
        @endforeach
@stop