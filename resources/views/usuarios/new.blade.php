@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
    <div class="container">
      <div class="row">
    <div class="col-md-10 col-md-offset-1">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <br>
          <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Cadastro de Usuário</h3>
              </div>
              <form role="form" method="POST" action="{{url('/usuarios/new')}}">
                  {{ csrf_field() }}
                  <div class="box-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Nome:</label>
                          <input type="text" class="form-control" name="name"  placeholder="Nome">
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">E-mail</label>
                          <input type="email" class="form-control" name="email" placeholder="E-mail">
                      </div>

                      <div class="form-group">
                          <label for="exampleInputPassword1">Tipo de usuário</label>
                          <select class="form-control" name="type" >
                              <option value="1" >Técnica</option>
                              <option value="2" >Médica</option>
                              <option value="3" >Administrador</option>
                          </select>
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">Senha</label>
                          <input type="password" class="form-control" name="password"  placeholder="Senha">
                      </div>

                  </div>
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Salvar</button>
                  </div>
              </form>
          </div>
    </div>
  </div>
</div>

@stop