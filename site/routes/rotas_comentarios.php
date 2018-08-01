<?php


Route::post('/comentar', 'ComentariosController@comentar');

Route::get('/deletarComentario/{id}', 'ComentariosController@deletar');
