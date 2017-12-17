@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@push('css')
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
@endpush

@section('content')
    <div class="row">
    @foreach($deletados as $delete)

            <div class="col-md-3" style="margin: 10px 5px">
                <span>{{$delete->nome}}</span><br>
                <span>Deletado: {{$delete->deleted_at}}</span><br>
                <a href="restaure/{{$delete->id}}">
                    <button class="btn btn-xs btn-success">RESTAURAR</button>
                </a>
            </div>
    @endforeach
    </div>
@endsection
