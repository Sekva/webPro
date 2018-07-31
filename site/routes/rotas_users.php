<?php


Route::get('/usuario/mostrarPerfil', 'UserController@mostrarPerfil');

Route::get('/usuario/{id}/editar', 'UserController@editar');

Route::post('/usuario/salvarEdicao', 'UserController@salvarEdicao');

Route::get('/usuario/{id}/checarDeletar', 'UserController@checarDeletar');

Route::get('/usuario/{id}/deletar', 'UserController@deletar');
