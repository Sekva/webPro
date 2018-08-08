<?php

Route::get('/amigos/ver/{id}', 'AmizadeController@verAmigo');

Route::get('/amigos/perfisExternosAmigos/{id}', 'AmizadeController@perfisExternosAmigos');

Route::get('/amigos/curadoriasAmigos/{id}', 'AmizadeController@curadoriasAmigos');

Route::middleware('auth')->group(function () {

   Route::get('/amigos/desfazerAmizade/{id}', 'AmizadeController@desfazerAmizade');

   Route::get('/amigos', 'AmizadeController@listarAmigos');

   Route::get('/amigos/aceitarAmizade/{id}', 'AmizadeController@aceitarAmizade');

   Route::get('/amigos/listarPedidosPraMim', 'AmizadeController@listarPedidosPraMim');

   Route::get('/amigos/soilicitarAmizade/{id}', 'AmizadeController@soilicitarAmizade');

   Route::get('/amigos/cancelarSolicitacao/{id}', 'AmizadeController@cancelarSolicitacao');

   Route::get('/amigos/listarAmigosDeOutro/{id}', 'AmizadeController@listarAmigosDeOutro');

   Route::get('/amigos/listarTodosUsers', 'AmizadeController@listarTodosUsers');

});
