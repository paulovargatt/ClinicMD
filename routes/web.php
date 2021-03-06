<?php

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', function () {
        return redirect('pacientes');
    });

    /**** USUÁRIOS */
    /*Senha*/
    Route::get('/alterar-senha', 'UsersController@senha');
    Route::POST('/change-password', 'UsersController@changePassword')->name('changePassword');

    /*Gerenciamento de usuários*/
    Route::get('/usuarios', 'UsersController@usuarios')->middleware('can:admin');
    Route::get('/user/{id}', 'UsersController@usuariosEdit')->middleware('can:admin');
    Route::post('/user/{id}/update', 'UsersController@usuariosUpdate')->middleware('can:admin');

    /* Cadastro de usuários:*/
    Route::get('/usuarios/novo', 'UsersController@usuariosNovo')->middleware('can:admin');
    Route::post('/usuarios/new', 'UsersController@usuariosNew')->middleware('can:admin');



    /*PACIENTE*/
    Route::get('/pacientes', 'Pacientes@index')->name('list');
    Route::get('/paciente/{id}', 'Pacientes@paciente')->name('paciente');
    Route::post('/paciente/{id}/update', 'Pacientes@updatePaciente');
    Route::post('/paciente/{id}/foto', 'Pacientes@fotoPaciente');
    Route::get('/paciente/delete-paciente/{id}', 'Pacientes@deletePaciente');
    Route::get('/paciente/deletados/vargatt', 'Pacientes@deletadosPaciente');
    Route::get('/paciente/deletados/restaure/{id}', 'Pacientes@restaurePaciente');
    /*Novo Paciente*/
    Route::get('/novo', 'Pacientes@novoPaciente');
    Route::post('/paciente/create', 'Pacientes@createPaciente');
    /*Search*/
    Route::get('/search/pacientes', 'Pacientes@searchPaciente');


    /*MOVIMENTAÇÕES*/
    Route::get('/movimentacoes/{id}', 'Pacientes@jsonDataPacientes')->name('jsonDataPacientes');
    Route::post('/new-movimentation/{id}', 'Pacientes@newMovimentation');
    Route::post('/edit-movimentation/{id}', 'Pacientes@editMovimentation');
    Route::get('/delete-movimentation/{id}', 'Pacientes@deleteMovimentation');
    Route::get('/get-movimentation/{id}', 'Pacientes@getMovimentation');

});

