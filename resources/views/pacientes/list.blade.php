@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Todos os Pacientes</h1>
@stop

@section('content')

    <table class="table" style="background: #fff">
        <tr>
            <th>ID</th>
            <th>Nome</th>
        </tr>
            @foreach($carga as $pacientes)
            <tr>
               <td>{{$pacientes->id}}</td>
                <td> <a href="paciente/{{$pacientes->id}}">{{$pacientes->nome}}</a></td>
            </tr>
        @endforeach
        <tr>
    </table>
@stop