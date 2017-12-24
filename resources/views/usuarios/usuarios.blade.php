@extends('adminlte::page')

@section('title', 'Usuarios')


@section('content')
    <div class="container" style="width: 95%">
      <div class="row">
          <div class="text-center">
              <h2>Usuários cadastrados:</h2>
              <br>
          </div>
          @foreach($users as $user)
              <a href="{{url('/user/'.$user->id)}}">
                  <div class="col-md-3" style="padding: 0px 5px; min-height: 150px;">
                      <div class="box box-primary">
                          <div class="box-body box-profile">
                              <h4 class="text-center">{!! $user->name == Auth::user()->name ? "$user->name ( <b style='color:red'>Você</b> )" : $user->name !!}</h4>
                              <ul class="list-group list-group-unbordered">
                                  <li class="list-group-item">
                                      <b>Email</b> <span class="pull-right pront">{{$user->email}}</span>
                                  </li>
                                  <li class="list-group-item">
                                      <b>Tipo</b> <span class="pull-right pront">
                                          @if($user->type == 1)
                                            {{'Técnica'}}
                                              @elseif($user->type ==2)
                                              {{'Médica'}}
                                              @else
                                              {{'Administrador'}}
                                          @endif
                                      </span>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </a>
              @endforeach
      </div>
    </div>

@stop