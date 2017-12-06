@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@push('css')
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    @endpush
@section('content')
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{$paciente->foto == "" ? "/images/user.png" : $paciente->foto}}" alt="User profile picture">

                <h3 class="profile-username text-center">{{$paciente->nome}}</h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Prontuario</b> <a class="pull-right">{{$paciente->prontuario == "" ? "#" : $paciente->prontuario}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Matricula</b> <a class="pull-right">{{$paciente->matricula == "" ? "#" : $paciente->matricula}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Convenio</b> <a class="pull-right">{{$paciente->convenio == "" ? "#" : $paciente->convenio}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <h4 class="text-center">Informações:</h4>
            <div class="row" style="padding: 0px 15px">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Sexo:</label>
                        <div class="input-group date">
                          <select class="form-control" style="width: 150px" >
                              <option >{{$paciente->sexo}}</option>
                          </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Estado Civil:</label>
                        <div class="input-group date">
                          <select class="form-control" style="width: 150px" >
                              <option >{{$paciente->est_civil}}</option>
                          </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group" >
                        <label>Nascimento:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{$paciente->nascimento->format('d/m/Y')}}" id="datepicker">
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Identidade</label>
                        <input type="text" class="form-control" value="{{$paciente->identidade}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>CPF:</label>
                        <input type="text" class="form-control" value="{{$paciente->cpf}}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" class="form-control" value="{{$paciente->email}}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Logradouro</label>
                        <input type="text" class="form-control" value="{{$paciente->logradouro}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" class="form-control" value="{{$paciente->complemento}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" class="form-control" value="{{$paciente->bairro}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" class="form-control" value="{{$paciente->cidade}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>UF</label>
                        <input type="text" class="form-control" value="{{$paciente->uf}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" class="form-control" value="{{$paciente->cep}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>TELEFONES</label>
                        <input type="text" class="form-control" value="{{$paciente->telefones}}">
                    </div>
                </div>
                <div class="pull-left">
                <button class="btn btn-success" style="margin: 5px 15px">Fazer Evolução</button>
                </div>
                <div class="pull-right">
                    <button class="btn btn-primary" style="margin: 5px 15px">Salvar modificações</button>
                </div>
            </div>
        </div>
    </div>
<br>
<br>
    <div class="col-md-12">
        <div class="box box-primary">
            <h4 class="text-center">Ultimas Evoluções:</h4>

        </div>
    </div>

@stop

@push('js')
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script>
        $('#datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
        })
    </script>
@endpush