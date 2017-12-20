@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@push('css')
@endpush

@section('content')
<div class="container">
    <div class="row">
        <h3 class="text-center">Alteraração de Senha</h3>

        <div class="col-md-4 col-md-offset-4" >
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                <label for="senha">Digite Sua Senha Atual:</label>
                <input type="password" class="form-control" name="current-password" required id="current-password" placeholder="Senha Atual">
                    @if ($errors->has('current-password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                    @endif
             </div>

            <div class="form-group">
                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                <label for="newsenha">Digite Sua Nova Senha:</label>
                <input type="password" class="form-control" name="new-password" id="new-password" placeholder="NOVA SENHA">

                    @if ($errors->has('new-password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                    @endif
             </div>

                <div class="form-group">
                    <label for="new-password-confirm">Confirme a nova senha</label>
                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" PLACEHOLDER="CONFIRME A NOVA SENHA" required>
                </div>


                   <div class="text-center">
                        <button type="submit" class="btn btn-success btn-block">Alterar Senha</button>
                   </div>
            </form>
        </div>

    </div>
</div>
@endsection

