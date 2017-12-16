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
                <div class="hiddenFileInputContainter">
                    <img class="profile-user-img img-responsive img-circle fileDownload"
                     src="{{$paciente->foto == "" ? "/images/user.png" : '../images/pacientes/'.$paciente->foto}}">
                    <form enctype="multipart/form-data" id="imageform"  method="POST">
                        <input title="Insira uma Imagem" type="file" name="image" class="inputimage" accept="image/*" />
                    </form>
                </div>

                <input class="profile-username text-center input-name" value="{{$paciente->nome}}">
                <h3 ></h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Idade:</b> <span class="pull-right input-small idad">{{$paciente->nascimento->diffForHumans(null,true)}} </span>
                    </li>
                    <li class="list-group-item">
                        <b>Prontuario</b> <input class="pull-right input-small pront" value="{{$paciente->prontuario == "" ? "00" : $paciente->prontuario}}" />
                    </li>

                    <li class="list-group-item">
                        <b>Convenio</b> <input c class="pull-right input-small conv" value="{{$paciente->convenio == "" ? "#" : $paciente->convenio}}"/>
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
                          <select class="form-control" id="sexo" style="width: 150px" >
                              <option value="feminino" {{$paciente->sexo == "feminino" ? "selected" : ''}}>Feminino</option>
                              <option value="masculino" {{$paciente->sexo == "masculino" ? "selected" : ''}}>Masculino</option>
                          </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Estado Civil:</label>
                        <div class="input-group date">
                          <select id="est-civil" class="form-control" style="width: 150px" >
                              <option value="casado" {{$paciente->est_civil == "casado" ? "selected" : ''}}>Casado(a)</option>
                              <option value="solteiro" {{$paciente->est_civil == "solteiro" ? "selected" : ''}}>Solteiro(a)</option>
                              <option value="viuvo" {{$paciente->est_civil == "viuvo" ? "selected" : ''}}>Viuvo(a)</option>
                              <option value="separado" {{$paciente->est_civil == "separado" ? "selected" : ''}}>Separado(a)</option>
                          </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group" >
                        <label>Nascimento:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="nascimento" value="{{$paciente->nascimento->format('d/m/Y')}}" id="datepicker">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Identidade</label>
                        <input type="text" class="form-control identidade" value="{{$paciente->identidade}}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>CPF:</label>
                        <input type="text" class="form-control cpf" value="{{$paciente->cpf}}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" class="form-control email" value="{{$paciente->email}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>TELEFONES</label>
                        <input type="text" class="form-control fones" value="{{$paciente->telefones}}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>UF</label>
                        <select id="uf" style="padding: 0"  default="{{$city[0]->uf}}"   class="form-control"></select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Cidade</label>
                        <select id="cidade" default="{{$city[0]->idcity}}" style="width: 100%"  class="form-control" >

                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Logradouro</label>
                        <input type="text" class="form-control logradouro"  value="{{$paciente->logradouro}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" class="form-control complemento" value="{{$paciente->complemento}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" class="form-control bairro" value="{{$paciente->bairro}}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" class="form-control cep" value="{{$paciente->cep}}">
                    </div>
                </div>

                <div class="pull-left">
                    <button type="button" onclick="addForm()" style="margin: 0px 15px" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        Fazer Evolução
                    </button>

                </div>
                <div class="pull-right">
                    <button class="btn btn-primary" id="salva-ficha" style="margin: 5px 15px">Salvar modificações</button>
                </div>
            </div>
        </div>
    </div>
<br>
<br>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Movimentações do Paciente:</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
                <div class="table-responsive">

                    <table id="movimentacoes" class="table table-bordered table-striped table-condensed ">
                        <thead>
                        <tr>
                            <th>Turno</th>
                            <th>Data</th>
                            <th>Criado Por</th>
                            <th>Mensagem</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="">
                          </div>
            <!-- /.box-footer -->

        </div>
    </div>


    <!-- MODAL -->

    <div class="modal fade" id="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Movimentação</h4>
                </div>
                <div class="modal-body">
                 <form method="post" id="modal" class="form-horizontal" data-toggle="validator">
                     {{csrf_field()}} {{method_field('POST')}}
                        <input type="hidden" id="id" name="id">
                        <div class="radio">
                            <label style="margin-right: 10px;">
                                <input name="turnos" id="manha" value="manha" checked="" type="radio">
                                <span class="label label-primary">Manhã </span>
                            </label>
                            <label style="margin-right: 10px;">
                                <input name="turnos" id="tarde" value="tarde" checked="" type="radio">
                                <span class="label label-success">Tarde  </span>
                            </label>
                            <label>
                                <input name="turnos" id="noite" value="noite" checked="" type="radio">
                                <span class="label label-bl" style="background: #090909">Noite</span>
                            </label>
                        </div>

                        <div class="form-group" style="padding: 15px 13px">
                            <label>Movimentação</label>
                            <textarea class="form-control" rows="3" name="descricao" placeholder="Digite a Evolução Aqui"></textarea>
                        </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                         <div class="pull-right"><button type="submit" class="btn btn-primary">Salvar</button></div>
                     </div>
                 </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

@stop

@push('js')
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <script src="/vendor/artesaos/cidades/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
    <script>
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var paciente = "{{$paciente->id}}";

        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('input[name=nascimento]').mask('00/00/0000');
        $('.cep').mask('00000-000');

        $('#uf').ufs({
            onChange: function(uf){
                $('#cidade').cidades({uf: uf});
            }
        });

        var table =  $('#movimentacoes').DataTable({
            processing:true,
            serverSide: true,
            ajax: '/movimentacoes/' + paciente,
            columns: [
                {data: 'turno', name: 'turno',orderable:false},
                {data: 'created_at', name: 'created_at',orderable:true},
                {data: 'type_user', name: 'type_user'},
                {data: 'descricao', name: 'descricao',orderable:false},
                {data: 'action', name: 'action', orderable:false},
            ],

            "language": {
                "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
            }
        });


        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-title').text('Adicionar');
        }

        $(document).on('#modal submit', function (e) {
            e.preventDefault();
            var id = $('#id').val();
            if (save_method == 'edit') {
                url = "/edit-movimentation/" + id;
            }
            else{
                url = "/new-movimentation/" + paciente;
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#modal-form form').serialize(),
                beforeSend: function(){
                    $('.loader').fadeIn();
                },
                complete: function(){
                    $('.loader').fadeOut("slow");
                },
                success: function ($data) {
                    $('#modal-form').modal('hide');
                      table.ajax.reload();
                },
                error : function(){
                    alert('Não foi possível salvar esse registro');
                }
            });
        });

        function editMovi(id) {
            save_method = "edit";
            $.ajax({
                url: '/get-movimentation/' + id,
                type: "GET",
                success: function (data) {
                    $('#modal-form').modal('show');
                    $('input[name=turnos][value="'+data.turno+'"]').prop("checked", true);
                    $('textarea[name=descricao]').val(data.descricao);
                    $('input[name=id]').val(data.id);
                },
                error: function () {
                    alert('Não foi possível salvar esse registro');
                }
            });
        }


        function deleteMovi(id) {
                $('[data-toggle=confirmation]').confirmation({
                    rootSelector: '[data-toggle=confirmation]',
                    btnOkClass:	'btn btn-xs btn-Warning',
                    btnCancelClass: 'btn-xs btn-default',
                    btnOkClass:	'btn btn-xs btn-danger',
                    btnOkLabel:	'Delete ?',
                    btnCancelLabel:	'No',
                    onConfirm: function() {
                        $.ajax({
                            url: '/delete-movimentation/' + id,
                            type: "GET",
                            success: function ($data) {
                                table.ajax.reload();
                            },
                            error : function(){
                                alert('Não foi possível salvar esse registro');
                            }
                        });
                    }
                });
        }

        $('#salva-ficha').on('click',function () {
            $.ajax({
                url: paciente + '/update',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": $('.input-name').val(),
                    "sexo":  $('#sexo').val(),
                    "est": $('#est-civil').val(),
                    "nascimento": $('input[name=nascimento]').val(),
                    "prontuario": $('.pront').val(),
                    "matricula": $('.matricula').val(),
                    "convenio": $('.conv').val(),
                    "uf": $('#uf').val(),
                    "cidade": $('#cidade').val(),
                    "identidade": $('.identidade').val(),
                    "cpf": $('.cpf').val(),
                    "email": $('.email').val(),
                    "fones": $('.fones').val(),
                    "logradouro": $('.logradouro').val(),
                    "complemento": $('.complemento').val(),
                    "bairro": $('.bairro').val(),
                    "cep": $('.cep').val()
                },
                beforeSend: function () {
                    $('.loader').fadeIn();
                },
                complete: function () {
                    $('.loader').fadeOut("slow");
                },
                success: function ($data) {
                    $('.list-group').load(' .list-group')
                }
            });
        });

        $('#datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
        });


        /*Image*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#imageform").on("change", function() {
            var postData = new FormData($("#imageform")[0]);
            $.ajax({
                url: /paciente/+ paciente + '/foto',
                type: 'POST',
                processData: false,
                contentType: false,
                data: postData,
                success: function () {
                    location.reload();
                },
                headers: {
                    "_token": "{{ csrf_token() }}"
                }
            });
        });



    </script>
@endpush