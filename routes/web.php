<?php

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    /*PACIENTE*/
    Route::get('/pacientes', 'Pacientes@index')->name('list');
    Route::get('/paciente/{id}', 'Pacientes@paciente')->name('paciente');
    Route::post('/paciente/{id}/update', 'Pacientes@updatePaciente');
    Route::post('/paciente/{id}/foto', 'Pacientes@fotoPaciente');


    /*MOVIMENTAÇÕES*/
    Route::get('/movimentacoes/{id}', 'Pacientes@jsonDataPacientes')->name('jsonDataPacientes');
    Route::post('/new-movimentation/{id}', 'Pacientes@newMovimentation');
    Route::post('/edit-movimentation/{id}', 'Pacientes@editMovimentation');
    Route::get('/delete-movimentation/{id}', 'Pacientes@deleteMovimentation');
    Route::get('/get-movimentation/{id}', 'Pacientes@getMovimentation');

});

