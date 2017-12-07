<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/pacientes', 'Pacientes@index')->name('list');
    Route::get('/paciente/{id}', 'Pacientes@paciente')->name('paciente');

    Route::post('/new-movimentation/{id}', 'Pacientes@newMovimentation');
});

