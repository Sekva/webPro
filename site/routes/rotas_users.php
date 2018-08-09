<?php

Route::middleware('auth')->group(function () {

   Route::get('/usuario/mostrarPerfil', 'UserController@mostrarPerfil');

   Route::get('/usuario/{id}/editar', 'UserController@editar');

   Route::post('/usuario/salvarEdicao', 'UserController@salvarEdicao');

   Route::get('/usuario/{id}/deletar', 'UserController@deletar');

});
