<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pacientes', 'Pacientes@index')->name('list');
Route::get('/paciente/{id}', 'Pacientes@paciente')->name('paciente');

