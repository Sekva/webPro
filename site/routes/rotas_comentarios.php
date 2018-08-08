<?php

Route::middleware('auth')->group(function () {

   Route::post('/comentar', 'ComentariosController@comentar');

   Route::get('/deletarComentario/{id}', 'ComentariosController@deletar');

});
