<?php

Route::middleware('auth')->group(function () {

   Route::post('/comentar', 'ComentariosController@comentar');

   Route::get('/deletarComentario/{id}', 'ComentariosController@deletar');

   Route::get('/editarComentario/{id}', 'ComentariosController@editarComentario');

   Route::post('/salvar_editarComentario', 'ComentariosController@salvar_editarComentario');

});
