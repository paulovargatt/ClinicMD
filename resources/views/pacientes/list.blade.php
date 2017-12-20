@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
    @foreach($carga as $pacientes)
        <a href="{{url('/paciente/'.$pacientes->id)}}">
            <div class="col-md-2" style="min-height: 275px!important;max-height: 276px;padding: 0px 6px;">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" style="min-height: 100px;"
                             src="{{$pacientes->foto == "" ? "/images/user.png" : '../images/pacientes/'.$pacientes->foto}}">
                        <h4 class="text-center">{{$pacientes->nome}}</h4>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Idade:</b> <span
                                        class="pull-right  idad">{{$pacientes->nascimento->diffForHumans(null,true)}} </span>
                            </li>
                            <li class="list-group-item">
                                <b>Prontuario</b> <span class="pull-right pront">{{$pacientes->prontuario}}</span>
                            </li>

                            <li class="list-group-item">
                                <b>Convenio</b> <span class="pull-right pront">{{$pacientes->convenio}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </a>
    @endforeach

    <div class="container">
        <div class="clear-fix " style=""></div>
        <div class="pull-left">
            {{ $carga->links() }}
        </div>

@stop