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
                  <h3 class="box-title">{{$user->name}}</h3>
              </div>
              <form role="form" method="POST" action="{{url('/user/'.$user->id.'/update')}}">
                  {{ csrf_field() }}
                  <div class="box-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Nome:</label>
                          <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="E-mail">
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">E-mail</label>
                          <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="E-mail">
                      </div>

                      @if ($user->id != Auth::user()->id)
                      <div class="form-group">
                          <label for="exampleInputPassword1">Tipo de usuário</label>
                          <select class="form-control" name="type" >
                              <option value="1" {{$user->type == 1 ? "selected" : "" }}>Técnica</option>
                              <option value="2" {{$user->type == 2 ? "selected" : "" }}>Médica</option>
                              <option value="3" {{$user->type == 3 ? "selected" : "" }}>Administrador</option>
                          </select>
                      </div>
                          @endif

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