<?php

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/pacientes', 'Pacientes@index')->name('list');
    Route::get('/paciente/{id}', 'Pacientes@paciente')->name('paciente');
    Route::get('/movimentacoes/{id}', 'Pacientes@jsonDataPacientes')->name('jsonDataPacientes');


    Route::post('/new-movimentation/{id}', 'Pacientes@newMovimentation');
});

