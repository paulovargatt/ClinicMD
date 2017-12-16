@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@push('css')
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
@endpush

@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <h4 class="text-center">Novo Paciente:</h4>
            <div class="row" style="padding: 0px 15px">
                <div class="col-md-4">
                <div class="box-body box-profile">
                    <div class="form-group">
                        <input class="profile-username text-center input-name" placeholder="Insira o Nome" >
                    </div>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Prontuario</b> <input class="pull-right input-small pront" placeholder="00" value="" />
                        </li>

                        <li class="list-group-item">
                            <b>Convenio</b> <input c class="pull-right input-small convenio"  placeholder="00" />
                        </li>
                    </ul>
                </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Sexo:</label>
                        <div class="input-group date">
                            <select class="form-control" id="sexo" style="width: 150px" >
                                <option value="feminino" >Feminino</option>
                                <option value="masculino" >Masculino</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Estado Civil:</label>
                        <div class="input-group date">
                            <select id="est-civil" class="form-control" style="width: 150px" >
                                <option value="casado" >Casado(a)</option>
                                <option value="solteiro" >Solteiro(a)</option>
                                <option value="viuvo" >Viuvo(a)</option>
                                <option value="separado" >Separado(a)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group" >
                        <label>Nascimento:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="nascimento" value="01/01/1990" id="datepicker">
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Identidade</label>
                        <input type="text" class="form-control identidade" value="">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>CPF:</label>
                        <input type="text" class="form-control cpf" value="">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" class="form-control email" value="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>TELEFONES</label>
                        <input type="text" class="form-control fones" value="">
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                        <label>UF</label>
                        <select id="uf" style="padding: 0"  default="RS"   class="form-control"></select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Cidade</label>
                        <select id="cidade" default="7994" required style="width: 100%"  class="form-control" >

                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Logradouro</label>
                        <input type="text" class="form-control logradouro"  value="">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" class="form-control complemento" value="">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" class="form-control bairro" value="">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" class="form-control cep" value="">
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-big" id="salva-ficha" style="margin: 5px 15px">Salvar Novo Paciente</button>
                </div>
            </div>
        </div>
    </div>

    @endsection


@push('js')
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <script src="/vendor/artesaos/cidades/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script>
        var csrf_token = $('meta[name="csrf-token"]').attr('content');


        $('.cpf').mask('000.000.000-00', {reverse: true});
        $('input[name=nascimento]').mask('00/00/0000');
        $('.cep').mask('00000-000');

        $('#uf').ufs({
            onChange: function(uf){
                $('#cidade').cidades({uf: uf});
            }
        });

        $('#salva-ficha').on('click',function () {
            $.ajax({
                url: '/paciente/create',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": $('.input-name').val(),
                    "sexo":  $('#sexo').val(),
                    "est": $('#est-civil').val(),
                    "nascimento": $('input[name=nascimento]').val(),
                    "prontuario": $('.pront').val(),
                    "matricula": $('.matricula').val(),
                    "convenio": $('.convenio').val(),
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
                dataType: 'json',
                beforeSend: function () {
                    $('.loader').fadeIn();
                },
                complete: function () {
                    $('.loader').fadeOut("slow");
                },
                error: function(){
                    toastr["error"]("Erro Ao Enviar");
                }
                ,success: function (data) {
                    if($.isEmptyObject(data.error)) {
                        toastr["success"](data);
                        window.location.href = "/paciente/" + data.id

                    }else{
                        toastr["error"](data.error);
                    }
                }
            });
        });

        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });


        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }


    </script>
@endpush